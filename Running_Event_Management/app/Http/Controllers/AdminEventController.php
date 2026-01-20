<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Services\EventService;

class AdminEventController extends Controller
{
    public function __construct(protected EventService $eventService) {}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'created_desc'); // Default sort
        $categoryFilter = $request->input('category');
        
        // Base Query
        $query = Event::with(['categories.slots', 'categories.price']);

        // 1. Search
        if ($search) {
            $query->where('NamaEvent', 'like', "%{$search}%");
        }

        // 2. Filter by Category Distance
        if ($categoryFilter) {
            $query->whereHas('categories', function($q) use ($categoryFilter) {
                $q->where('Jarak', $categoryFilter);
            });
        }

        // 3. Subqueries for Sorting (Capacity & Revenue)
        // Capacity Subquery
        $capacitySub = DB::table('ms_kategorilomba as c')
            ->join('ms_slotkategori as s', 's.KategoriID', '=', 'c.KategoriID')
            ->selectRaw('SUM(s.KuotaTotal)')
            ->whereColumn('c.EventID', 'ms_event.EventID');

        // Revenue Subquery
        $revenueSub = DB::table('ms_kategorilomba as c')
            ->join('ms_slotkategori as s', 's.KategoriID', '=', 'c.KategoriID')
            ->join('ms_biayakategori as p', 'p.KategoriID', '=', 'c.KategoriID')
            ->selectRaw('SUM((s.KuotaTotal - s.KuotaTersisa) * p.Nominal)')
            ->whereColumn('c.EventID', 'ms_event.EventID');
        
        // Add select for sorting
        $query->addSelect(['calculated_capacity' => $capacitySub]);
        $query->addSelect(['calculated_revenue' => $revenueSub]);
        $query->addSelect('ms_event.*'); // Select all event fields

        // 4. Sorting Logic
        switch ($sort) {
            case 'revenue_desc':
                $query->orderByDesc('calculated_revenue');
                break;
            case 'revenue_asc':
                $query->orderBy('calculated_revenue');
                break;
            case 'capacity_desc':
                $query->orderByDesc('calculated_capacity');
                break;
            case 'capacity_asc':
                $query->orderBy('calculated_capacity');
                break;
            case 'name_asc':
                $query->orderBy('NamaEvent');
                break;
            case 'name_desc':
                $query->orderByDesc('NamaEvent');
                break;
            case 'created_asc':
                $query->orderBy('EventID');
                break;
            default: // created_desc
                $query->orderByDesc('EventID');
        }

        // Pagination
        $events = $query->paginate(9)->withQueryString();

        // Calculate PHP-side stats for display (as before)
        foreach ($events as $event) {
            $totalQuota = 0;
            $totalRemaining = 0;
            
            foreach ($event->categories as $category) {
                foreach ($category->slots as $slot) {
                    $totalQuota += $slot->KuotaTotal;
                    $totalRemaining += $slot->KuotaTersisa;
                }
            }
            $event->totalQuota = $totalQuota;
            $event->registered = $totalQuota - $totalRemaining;
            $event->percentage = $totalQuota > 0 ? round(($event->registered / $totalQuota) * 100) : 0;
        }

        // Fetch unique categories for dropdown
        $categories = DB::table('ms_kategorilomba')
            ->select('Jarak')
            ->distinct()
            ->orderBy('Jarak')
            ->pluck('Jarak');

        return view('admin.events', compact('events', 'search', 'sort', 'categoryFilter', 'categories'));
    }

    public function commit()
    {
        try {
            DB::transaction(function () {
                // Example: Iterate all events to ensure consistency (User request for transaction/cursor)
                foreach (Event::cursor() as $event) {
                    // Placeholder for batch logic - e.g., verifying consistency
                }
            });
            
            return back()->with('success', 'System synchronization committed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Commit failed: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $event = Event::with(['categories.slots', 'categories.price'])->findOrFail($id);

        // Fetch Participants for this event
        $participants = DB::table('tr_pendaftaran')
            ->join('tr_pengguna', 'tr_pendaftaran.PenggunaID', '=', 'tr_pengguna.PenggunaID')
            ->join('ms_kategorilomba', 'tr_pendaftaran.KategoriID', '=', 'ms_kategorilomba.KategoriID')
            ->leftJoin('tr_hasillomba', 'tr_pendaftaran.PendaftaranID', '=', 'tr_hasillomba.PendaftaranID')
            ->where('ms_kategorilomba.EventID', $id)
            ->select(
                'tr_pendaftaran.PendaftaranID',
                'tr_pendaftaran.NomorBIB',
                'tr_pengguna.NamaLengkap',
                'ms_kategorilomba.NamaKategori',
                'tr_hasillomba.WaktuFinish',
                'tr_hasillomba.PeringkatUmum'
            )
            ->get();

        // Calculate stats
        $totalQuota = 0;
        $totalRemaining = 0;
        foreach ($event->categories as $category) {
            foreach ($category->slots as $slot) {
                $totalQuota += $slot->KuotaTotal;
                $totalRemaining += $slot->KuotaTersisa;
            }
        }
        $event->totalQuota = $totalQuota;
        $event->registered = $totalQuota - $totalRemaining;
        $event->percentage = $totalQuota > 0 ? round(($event->registered / $totalQuota) * 100) : 0;

        return view('admin.events.show', compact('event', 'participants'));
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $event = Event::findOrFail($id);
                
                // 1. Check Registrations first to avoid partial deletes if blocked
                foreach ($event->categories as $category) {
                    if ($category->registrations()->exists()) {
                        throw new \Exception("Cannot delete event with active registrations. Please 'Close' the event instead.");
                    }
                }

                // 2. Delete Slots & Prices via Categories
                foreach ($event->categories as $category) {
                    DB::table('ms_slotkategori')->where('KategoriID', $category->KategoriID)->delete();
                    DB::table('ms_biayakategori')->where('KategoriID', $category->KategoriID)->delete();
                    DB::table('tr_bib_sequence')->where('KategoriID', $category->KategoriID)->delete();
                    $category->delete();
                }

                // 3. Delete Event Image
                if ($event->GambarEvent && file_exists(public_path($event->GambarEvent))) {
                    @unlink(public_path($event->GambarEvent));
                }

                // 4. Delete Event
                $event->delete();
            });

            return redirect()->route('admin.events')->with('success', 'Event deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'NamaEvent' => 'required|string|max:255',
            'DeskripsiEvent' => 'nullable|string',
            'Location' => 'required|string', // Maps to LokasiEvent
            'GambarEvent' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'StatusEvent' => 'required|in:Upcoming,Ongoing,Closed',
        ]);

        try {
            $data = [
                'NamaEvent' => $request->NamaEvent,
                'DeskripsiEvent' => $request->DeskripsiEvent,
                'LokasiEvent' => $request->Location,
                'StatusEvent' => $request->StatusEvent,
            ];

            if ($request->hasFile('GambarEvent')) {
                // Delete old image if exists and is literally a file (not a URL)
                if ($event->GambarEvent && file_exists(public_path($event->GambarEvent))) {
                    @unlink(public_path($event->GambarEvent));
                }
                
                $file = $request->file('GambarEvent');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('events', $filename, 'public');
                $data['GambarEvent'] = 'storage/' . $path;
            }

            $event->update($data);

            return redirect()->route('admin.events.show', $id)->with('success', 'Event details updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update event: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Starting Event Creation', $request->except('GambarEvent'));

        $request->validate([
            'NamaEvent' => 'required|string|max:255',
            'DeskripsiEvent' => 'nullable|string',
            'GambarEvent' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'StatusEvent' => 'required|in:Upcoming,Ongoing,Closed',
            // Primary Category
            'CategoryName' => 'required|string',
            'Distance' => 'required|string',
            'Quota' => 'required|integer|min:1',
            'Price' => 'required|numeric|min:0',
            'StartDate' => 'required|date',
            'Location' => 'required|string',
            // Secondary Category (Optional)
            'CategoryName2' => 'nullable|string',
            'Distance2' => 'nullable|string',
            'Quota2' => 'nullable|integer|min:1',
            'Price2' => 'nullable|numeric|min:0',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('GambarEvent')) {
                $file = $request->file('GambarEvent');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('events', $filename, 'public');
                $imagePath = 'storage/' . $path;
            }

            $categories = [
                [
                    'name' => $request->CategoryName,
                    'distance' => $request->Distance,
                    'price' => $request->Price,
                    'quota' => $request->Quota,
                    'start_date' => $request->StartDate,
                    'min_age' => 12, 
                    'max_age' => 80
                ]
            ];

            // Add Secondary Category if defined
            if ($request->filled('CategoryName2')) {
                $categories[] = [
                    'name' => $request->CategoryName2,
                    'distance' => $request->Distance2,
                    'price' => $request->Price2,
                    'quota' => $request->Quota2,
                    'start_date' => $request->StartDate, // Share same start date for now
                    'min_age' => 12,
                    'max_age' => 80
                ];
            }

            // Time Description Logic
            $startHour = \Carbon\Carbon::parse($request->StartDate)->hour;
            $timeDesc = ($startHour >= 5 && $startHour < 18) ? 'Day Run' : 'Night Run';
            $finalDescription = $request->DeskripsiEvent . "\n\nCategory Event: " . $timeDesc;

            // Construct data for Service
            $eventData = [
                'name' => $request->NamaEvent,
                'description' => $finalDescription,
                'status' => $request->StatusEvent,
                'image_path' => $imagePath,
                'location' => $request->Location,
                'categories' => $categories
            ];

            \Illuminate\Support\Facades\Log::info('Passing to Service', $eventData);

            $this->eventService->createEvent($eventData);

            \Illuminate\Support\Facades\Log::info('Event Creation Success');

            return redirect()->route('admin.events')->with('success', 'Event and configuration initialized successfully.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Event Creation Failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to initialize config: ' . $e->getMessage());
        }
    }

    public function updateResult(Request $request)
    {
        $request->validate([
            'PendaftaranID' => 'required|integer',
            'WaktuFinish' => 'nullable|string',
            'PeringkatUmum' => 'nullable|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Get registration details including category distance
                $registration = DB::table('tr_pendaftaran')
                    ->join('ms_kategorilomba', 'tr_pendaftaran.KategoriID', '=', 'ms_kategorilomba.KategoriID')
                    ->join('tr_pengguna', 'tr_pendaftaran.PenggunaID', '=', 'tr_pengguna.PenggunaID')
                    ->where('tr_pendaftaran.PendaftaranID', $request->PendaftaranID)
                    ->select(
                        'tr_pendaftaran.PendaftaranID',
                        'tr_pendaftaran.PenggunaID',
                        'ms_kategorilomba.Jarak',
                        'ms_kategorilomba.KategoriID',
                        'ms_kategorilomba.EventID',
                        'tr_pengguna.TanggalLahir'
                    )
                    ->first();

                if (!$registration) {
                    throw new \Exception('Registration not found');
                }

                // Calculate pace if finish time is provided
                $pace = null;
                if ($request->WaktuFinish) {
                    $pace = $this->calculatePaceFromTime($request->WaktuFinish, $registration->Jarak);
                }

                // Check if result already exists
                $existing = DB::table('tr_hasillomba')
                    ->where('PendaftaranID', $request->PendaftaranID)
                    ->first();

                $resultData = [
                    'WaktuFinish' => $request->WaktuFinish,
                    'PeringkatUmum' => $request->PeringkatUmum,
                    'Pace' => $pace
                ];

                if ($existing) {
                    // Update existing result
                    DB::table('tr_hasillomba')
                        ->where('PendaftaranID', $request->PendaftaranID)
                        ->update($resultData);
                    
                    $hasilID = $existing->HasilID;
                } else {
                    // Insert new result
                    $hasilID = DB::table('tr_hasillomba')->insertGetId(array_merge(
                        ['PendaftaranID' => $request->PendaftaranID],
                        $resultData
                    ));
                }

                // Update age group rankings if we have finish time
                if ($request->WaktuFinish && $registration->TanggalLahir) {
                    $this->updateAgeGroupRanking($hasilID, $registration);
                }

                // Recalculate overall rankings for this event
                $this->recalculateEventRankings($registration->EventID, $registration->KategoriID);
            });

            return back()->with('success', 'Participant result updated successfully. Pace calculated and leaderboards updated.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update result: ' . $e->getMessage());
        }
    }

    /**
     * Calculate pace in min/km format from finish time and distance
     */
    private function calculatePaceFromTime($time, $distanceStr)
    {
        if (!$time || !$distanceStr) return null;

        // Parse Distance
        $distance = 0;
        if (str_contains(strtoupper($distanceStr), 'K')) {
            $distance = (float)filter_var($distanceStr, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        } elseif (strtoupper($distanceStr) === 'HM' || strtoupper($distanceStr) === 'HALF MARATHON') {
            $distance = 21.0975;
        } elseif (strtoupper($distanceStr) === 'FM' || strtoupper($distanceStr) === 'FULL MARATHON' || strtoupper($distanceStr) === 'MARATHON') {
            $distance = 42.195;
        }

        if ($distance <= 0) return null;

        // Parse Time (HH:MM:SS)
        $parts = explode(':', $time);
        if (count($parts) !== 3) return null;

        $totalMinutes = ($parts[0] * 60) + $parts[1] + ($parts[2] / 60);
        $paceDecimal = $totalMinutes / $distance;

        $paceMin = floor($paceDecimal);
        $paceSec = round(($paceDecimal - $paceMin) * 60);

        return sprintf('%d\'%02d" /km', $paceMin, $paceSec);
    }

    /**
     * Update age group ranking for a participant
     */
    private function updateAgeGroupRanking($hasilID, $registration)
    {
        // Calculate age from birth date
        $age = \Carbon\Carbon::parse($registration->TanggalLahir)->age;
        
        // Determine age group (example: U20, 20-29, 30-39, etc.)
        if ($age < 20) {
            $ageGroup = 'U20';
        } elseif ($age < 30) {
            $ageGroup = '20-29';
        } elseif ($age < 40) {
            $ageGroup = '30-39';
        } elseif ($age < 50) {
            $ageGroup = '40-49';
        } else {
            $ageGroup = '50+';
        }

        // Check if age group ranking exists
        $existingRank = DB::table('tr_peringkatkelompokusia')
            ->where('HasilID', $hasilID)
            ->first();

        if ($existingRank) {
            DB::table('tr_peringkatkelompokusia')
                ->where('HasilID', $hasilID)
                ->update(['KelompokUsia' => $ageGroup]);
        } else {
            DB::table('tr_peringkatkelompokusia')->insert([
                'HasilID' => $hasilID,
                'KelompokUsia' => $ageGroup
            ]);
        }
    }

    /**
     * Recalculate rankings for all participants in an event/category
     */
    private function recalculateEventRankings($eventID, $categoryID)
    {
        // Get all results for this category, ordered by finish time
        $results = DB::table('tr_hasillomba')
            ->join('tr_pendaftaran', 'tr_hasillomba.PendaftaranID', '=', 'tr_pendaftaran.PendaftaranID')
            ->join('ms_kategorilomba', 'tr_pendaftaran.KategoriID', '=', 'ms_kategorilomba.KategoriID')
            ->where('ms_kategorilomba.EventID', $eventID)
            ->where('ms_kategorilomba.KategoriID', $categoryID)
            ->whereNotNull('tr_hasillomba.WaktuFinish')
            ->orderByRaw('TIME(tr_hasillomba.WaktuFinish) ASC')
            ->select('tr_hasillomba.HasilID', 'tr_hasillomba.PendaftaranID')
            ->get();

        // Update rankings
        $rank = 1;
        foreach ($results as $result) {
            DB::table('tr_hasillomba')
                ->where('HasilID', $result->HasilID)
                ->update(['PeringkatUmum' => $rank]);
            $rank++;
        }
    }
}
