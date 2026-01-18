<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('categories.slots')->get();

        // Sort by earliest slot date
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

        return view('dashboard.events.index', compact('events'));
    }
}
