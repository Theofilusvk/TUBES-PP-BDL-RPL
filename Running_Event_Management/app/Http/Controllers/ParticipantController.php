<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    public function index()
    {
        // Stats
        $totalParticipants = User::where('PeranID', 4)->count();
        $pendingVerifications = DB::table('tr_pendaftaran')
            ->whereIn('StatusPendaftaran', ['Menunggu Pembayaran', 'Menunggu Verifikasi'])
            ->count();
        $totalDistance = DB::table('total_distances')->sum('TotalDistance');
        $activeClubs = 12; // Placeholder

        // Participants List
        $participants = User::where('PeranID', 4)
            ->with('totalDistance') // Eager load distance
            ->orderBy('NamaLengkap')
            ->paginate(10);

        return view('dashboard.participants.index', compact('totalParticipants', 'pendingVerifications', 'totalDistance', 'activeClubs', 'participants'));
    }

    public function show($id)
    {
        $participant = User::with('totalDistance')->findOrFail($id);
        return view('dashboard.participants.show', compact('participant'));
    }
}
