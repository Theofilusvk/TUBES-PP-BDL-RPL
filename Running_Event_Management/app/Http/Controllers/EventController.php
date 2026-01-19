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
            $query->where('StatusEvent', 'Tutup');
        } elseif ($filter == 'my_events') {
             $query->whereHas('categories.registrations', function($q) {
                 $q->where('PenggunaID', auth()->id());
             });
        } else {
            $query->where('StatusEvent', '!=', 'Tutup');
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
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'payment_proof.required' => 'Please upload your payment evidence.',
            'category_id.required' => 'Please select a category.'
        ]);

        try {
            DB::beginTransaction();

            $categoryId = $request->category_id;
            $userId = auth()->id();

            // Check if already registered
            $exists = DB::table('tr_pendaftaran')
                ->where('PenggunaID', $userId)
                ->where('KategoriID', $categoryId)
                ->exists();

            if ($exists) {
                return back()->with('error', 'You are already registered for this category.');
            }

            // 1. Create Registration (Pending)
            $registrationId = DB::table('tr_pendaftaran')->insertGetId([
                'PenggunaID' => $userId,
                'KategoriID' => $categoryId,
                'StatusPendaftaran' => 'Menunggu Pembayaran', // Pending Approval
                'TanggalPendaftaran' => now(),
                'NomorBIB' => 'BIB-' . rand(1000, 9999), 
            ]);

            // 2. Upload Image
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('payments', $filename, 'public'); // Ensure storage link
                
                // 3. Create Payment Record
                DB::table('tr_pembayaran')->insert([
                    'PendaftaranID' => $registrationId,
                    'TanggalBayar' => now(),
                    'NominalBayar' => 0, // Should fetch from category price ideally
                    'MetodeID' => 1, // Default Transfer
                    'StatusPembayaran' => 'Menunggu Konfirmasi',
                    'BuktiPembayaran' => 'storage/' . $path
                ]);
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
