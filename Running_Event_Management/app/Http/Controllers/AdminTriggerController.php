<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTriggerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch System Logs (log_aktivitas)
        // Assuming table 'log_aktivitas' exists from 'create_system_logs_tables.php'
        // Fetch System Logs (tr_logaktivitassistem)
        $query = DB::table('tr_logaktivitassistem')
            ->join('tr_pengguna', 'tr_logaktivitassistem.PenggunaID', '=', 'tr_pengguna.PenggunaID')
            ->select('tr_logaktivitassistem.*', 'tr_pengguna.Username', 'tr_pengguna.NamaLengkap');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('tr_logaktivitassistem.DetailAktivitas', 'like', "%{$search}%")
                  ->orWhere('tr_logaktivitassistem.TipeAktivitas', 'like', "%{$search}%")
                  ->orWhere('tr_pengguna.Username', 'like', "%{$search}%")
                  ->orWhere('tr_pengguna.NamaLengkap', 'like', "%{$search}%");
            });
        }

        $logs = $query->orderBy('WaktuLog', 'desc')
            ->limit(100)
            ->get();

        // Database Object Status (Mocked or queried from information_schema if possible)
        // For demonstration, we'll mock the status of Triggers/Procedures
        $dbObjects = [
            [
                'name' => 'trg_update_race_slots',
                'type' => 'Trigger',
                'status' => 'Active',
                'latency' => '0.004s',
                'last_exec' => '2m ago'
            ],
            [
                'name' => 'sp_generate_bib_numbers',
                'type' => 'Stored Proc',
                'status' => 'Active',
                'latency' => '0.842s',
                'last_exec' => '15m ago'
            ]
        ];

        return view('admin.triggers', [
            'logs' => $logs,
            'dbObjects' => $dbObjects
        ]);
    }
}
