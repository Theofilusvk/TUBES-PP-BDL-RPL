<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class AdminEventController extends Controller
{
    public function index()
    {
        // Fetch Events
        // Assuming Event model maps to 'ms_event'
        $events = Event::orderBy('tanggal_mulai', 'desc')->paginate(10);

        return view('admin.events', [
            'events' => $events
        ]);
    }

    // Add create/store/edit/update methods as needed
}
