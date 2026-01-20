<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Total Participants
        $totalParticipants = User::where('PeranID', 4)->count();

        // 2. Total Admins
        $totalAdmins = User::where('PeranID', 1)->count();
        
        // 3. Total Accounts
        $totalAccounts = User::count();
        
        // 3. System Status
        $systemStatus = 'OPERATIONAL';
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $systemStatus = 'ERROR';
        }

        // 4. Total Revenue
        $revenue = DB::table('tr_pembayaran')
            ->where('StatusPembayaran', 'Lunas')
            ->sum('NominalBayar');

        // 5. Analytics Chart Data
        $range = $request->query('range', '7D');
        $query = DB::table('tr_pendaftaran');
        
        if ($range == '30D') {
            $startDate = now()->subDays(30);
            $groupBy = "DATE_FORMAT(TanggalPendaftaran, '%Y-%m-%d')";
        } elseif ($range == '1Y') {
            $startDate = now()->subYear();
            $groupBy = "DATE_FORMAT(TanggalPendaftaran, '%Y-%m')";
        } else {
            $startDate = now()->subDays(7);
            $groupBy = "DATE_FORMAT(TanggalPendaftaran, '%Y-%m-%d')";
        }

        $chartDataRaw = $query
            ->where('TanggalPendaftaran', '>=', $startDate)
            ->select(DB::raw("$groupBy as date"), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $maxVal = $chartDataRaw->max('count') ?: 1;
        
        $chartData = $chartDataRaw->map(function($item) use ($maxVal) {
            return [
                'label' => $item->date,
                'formatted_date' => \Carbon\Carbon::parse($item->date)->format('M d'),
                'value' => $item->count,
                'height' => round(($item->count / $maxVal) * 100)
            ];
        });

        // 6. Recent Logs (Triggers)
        $recentLogs = [];
        try {
            $recentLogs = DB::table('tr_logaktivitassistem')
                ->orderBy('WaktuLog', 'desc')
                ->limit(4)
                ->get()
                ->map(function($log) {
                    return [
                        'type' => $log->Aktivitas,
                        'message' => $log->Keterangan,
                        'time' => \Carbon\Carbon::parse($log->WaktuLog)->diffForHumans(),
                        'status' => 'SUCCESS' 
                    ];
                })->toArray(); // Ensure Array
        } catch (\Exception $e) {
            $recentLogs = [];
        }

        return view('admin.dashboard', [
            'totalParticipants' => $totalParticipants,
            'totalAdmins' => $totalAdmins,
            'totalAccounts' => $totalAccounts,
            'systemStatus' => $systemStatus,
            'revenue' => $revenue,
            'recentLogs' => $recentLogs,
            'chartData' => $chartData,
            'range' => $range
        ]);
    }
}
