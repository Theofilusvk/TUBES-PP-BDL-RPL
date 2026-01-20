<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'upcoming');
        $query = Event::with('categories.slots');

        if ($filter == 'past') {
            $query->where('StatusEvent', 'Buka')
                  ->whereDoesntHave('categories.slots', function($q) {
                $q->where('TanggalMulai', '>=', now());
            });
        } elseif ($filter == 'my_events') {
             $query->whereHas('categories.registrations', function($q) {
                 $q->where('PenggunaID', auth()->id())
                   ->where('StatusPendaftaran', '!=', 'Pendaftaran Ditolak')
                   ->whereDoesntHave('payment', function($qp) {
                       $qp->where('StatusPembayaran', 'Ditolak');
                   });
             });
        } else {
            $query->where('StatusEvent', 'Buka')
                  ->whereHas('categories.slots', function($q) {
                $q->where('TanggalMulai', '>=', now());
            });
        }

        $events = $query->get();

        // Sort by earliest slot date (or just created_at/date if available)
        $events = $events->sortBy(function($event) {
            $earliest = null;
            foreach($event->categories as $cat) {
                foreach($cat->slots as $slot) {
                    if ($slot->TanggalMulai && (!$earliest || $slot->TanggalMulai < $earliest)) {
                        $earliest = $slot->TanggalMulai;
                    }
                }
            }
            return $earliest ?? now()->addYears(10);
        });

        // Check for user registration
        $userId = auth()->id();
        foreach ($events as $event) {
            $event->userRegistration = null;
            if ($userId) {
                foreach ($event->categories as $category) {
                    $reg = $category->registrations->where('PenggunaID', $userId)->first();
                    if ($reg) {
                        // Load payment info manually or via relationship if defined
                        $payment = DB::table('tr_pembayaran')->where('PendaftaranID', $reg->PendaftaranID)->first();
                        $reg->payment = $payment;
                        $event->userRegistration = $reg;
                        
                        // If we have a registration, we can break (assuming 1 reg per event for now)
                        break; 
                    }
                }
            }
        }

        // Pass filter to view for tab active state
        return view('dashboard.events.index', compact('events', 'filter'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'category_id' => 'required',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:10240', // Increased to 10MB
        ], [
            'payment_proof.required' => 'Please upload your payment evidence.',
            'category_id.required' => 'Please select a category.',
            'payment_proof.max' => 'The image size must not exceed 10MB.'
        ]);

        try {
            DB::beginTransaction();

            $categoryId = $request->category_id;
            $userId = auth()->id();

            // Check if already registered
            $existingReg = DB::table('tr_pendaftaran')
                ->where('PenggunaID', $userId)
                ->where('KategoriID', $categoryId)
                ->first();

            // Check duplicate but allow if Rejected (Registration OR Payment)
            $isRejected = false;
            if ($existingReg) {
                if ($existingReg->StatusPendaftaran == 'Pendaftaran Ditolak') {
                    $isRejected = true;
                } else {
                     // Check if payment is rejected
                     $payment = DB::table('tr_pembayaran')->where('PendaftaranID', $existingReg->PendaftaranID)->orderBy('PembayaranID', 'desc')->first();
                     if ($payment && $payment->StatusPembayaran == 'Ditolak') {
                         $isRejected = true;
                     }
                }
            }

            if ($existingReg && !$isRejected) {
                 return back()->with('error', 'You are already registered for this category.');
            }

            if ($existingReg) {
                // Re-submission: Update status
                $registrationId = $existingReg->PendaftaranID;
                DB::table('tr_pendaftaran')
                    ->where('PendaftaranID', $registrationId)
                    ->update(['StatusPendaftaran' => 'Menunggu Pembayaran']);
            } else {
                 // 1. Get Category Info for Distance & EventID
                $category = DB::table('ms_kategorilomba')->where('KategoriID', $categoryId)->first();
                $eventId = $category->EventID; // Assuming EventID is present
                
                // Extract Distance (e.g., '10K' -> '10')
                $distanceStr = preg_replace('/[^0-9]/', '', $category->Jarak);
                if(empty($distanceStr)) $distanceStr = '00';

                // 2. Get Next Sequence
                $sequenceRec = DB::table('tr_bib_sequence')
                    ->where('EventID', $eventId)
                    ->where('KategoriID', $categoryId)
                    ->lockForUpdate()
                    ->first();
                
                if (!$sequenceRec) {
                    $newSeq = 1;
                    DB::table('tr_bib_sequence')->insert([
                        'EventID' => $eventId,
                        'KategoriID' => $categoryId,
                        'LastSequence' => $newSeq,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                } else {
                    $newSeq = $sequenceRec->LastSequence + 1;
                    DB::table('tr_bib_sequence')
                        ->where('id', $sequenceRec->id)
                        ->update(['LastSequence' => $newSeq, 'updated_at' => now()]);
                }

                // 3. Format BIB: EventID (2) - Distance (2) - Sequence (4)
                $bibNumber = sprintf('%02d-%s-%04d', $eventId % 100, $distanceStr, $newSeq);

                 // New Registration
                $registrationId = DB::table('tr_pendaftaran')->insertGetId([
                    'PenggunaID' => $userId,
                    'KategoriID' => $categoryId,
                    'StatusPendaftaran' => 'Menunggu Pembayaran', // Pending Approval
                    'TanggalPendaftaran' => now(),
                    'NomorBIB' => $bibNumber, 
                ]);
            }

            // 2. Upload Image
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('payments', $filename, 'public'); // Ensure storage link
                
                // 3. Create or Update Payment Record
                DB::table('tr_pembayaran')->updateOrInsert(
                    ['PendaftaranID' => $registrationId],
                    [
                        'TanggalBayar' => now(),
                        'NominalBayar' => 0, 
                        'MetodeID' => 1, 
                        'StatusPembayaran' => 'Menunggu Konfirmasi',
                        'BuktiPembayaran' => 'storage/' . $path
                    ]
                );
            }

            DB::commit();

            return redirect()->route('dashboard.events', ['filter' => 'my_events'])
                ->with('success', 'Registration successful! Your payment is under review.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }
}
