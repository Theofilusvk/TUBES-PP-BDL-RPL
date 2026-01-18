<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'upcoming');
        $query = Event::with('categories.slots');

        if ($filter == 'past') {
            $query->where('StatusEvent', 'Tutup');
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

        // Pass filter to view for tab active state
        return view('dashboard.events.index', compact('events', 'filter'));
    }
}
