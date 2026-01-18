<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class ParticipantDashboardController extends Controller
{
    public function index()
    {
        // For development, if not logged in, login as the first user
        if (!Auth::check()) {
            $user = \App\Models\User::where('PeranID', 4)->first();
            if ($user) {
                Auth::login($user);
            }
        }

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // 1. Registered Events Count
        $registeredCount = Registration::where('PenggunaID', $user->PenggunaID)->count();

        // 2. Upcoming Events (Mock logic: Events starting in future)
        // Note: SlotCategory determines dates, but Event status is on ms_event or ms_slotkategori
        // We'll simplisticly take events with 'Buka' status
        $upcomingEvents = Event::where('StatusEvent', 'Buka')->take(3)->get();

        // 3. User's specific registrations with details
        $myRegistrations = Registration::with(['category.event', 'payment'])
                                       ->where('PenggunaID', $user->PenggunaID)
                                       ->orderBy('TanggalPendaftaran', 'desc')
                                       ->take(5)
                                       ->get();

        return view('dashboard.index', [
            'user' => $user,
            'registeredCount' => $registeredCount,
            'upcomingEvents' => $upcomingEvents,
            'myRegistrations' => $myRegistrations
        ]);
    }
}
