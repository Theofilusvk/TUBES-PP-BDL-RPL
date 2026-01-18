<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Total Active Users
        // Assuming 'PeranID' 2 is User/Participant. Adjust based on your Role table.
        // Assuming Users are always "Active" unless soft-deleted, or check a status column if exists.
        $totalUsers = User::count(); 

        // 2. Ongoing Events
        // Assuming 'TanggalMulai' and 'TanggalSelesai' exist
        $activeEvents = Event::whereDate('TanggalMulai', '<=', now())
                             ->whereDate('TanggalSelesai', '>=', now())
                             ->count();
        
        // 3. System Health / Status
        // Mocked as Operational for now, or check DB connection
        $systemStatus = 'OPERATIONAL';
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $systemStatus = 'ERROR';
        }

        // 4. Registration Analytics (Mocked or simple count)
        // If Registration model exists:
        // $recentRegistrations = Registration::where('created_at', '>=', now()->subDays(7))->count();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'activeEvents' => $activeEvents,
            'systemStatus' => $systemStatus,
            // 'revenue' => ... (fetch from Payment)
        ]);
    }
}
