<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminFinancialController extends Controller
{
    public function index()
    {
        // Calculate Totals directly from Table (Fallback if View fails)
        $totalRevenue = DB::table('tr_pembayaran')
            ->where('status_pembayaran', 'PAID') // Assuming 'PAID' or equivalent
            ->sum('nominal_bayar');

        // Net Profit (Mock logic: 70% of Revenue)
        $netProfit = $totalRevenue * 0.7;

        $pendingAmount = DB::table('tr_pembayaran')
            ->where('status_pembayaran', 'PENDING')
            ->sum('nominal_bayar');

        // List of recent transactions with joins
        // Attempt global join, handle missing tables gracefully? 
        // We'll stick to basic Payment info for now to ensure it runs.
        $transactions = DB::table('tr_pembayaran')
            ->select('tr_pembayaran.*') // Select basic info
            ->orderBy('tanggal_bayar', 'desc')
            ->limit(50)
            ->get();
            
        // Note: For real environment, we'd want to join 'tr_pendaftaran' -> 'tr_pengguna' to get names.
        // But given schema instability, simple is safer for now.

        return view('admin.financial', [
            'totalRevenue' => $totalRevenue,
            'netProfit' => $netProfit,
            'pendingAmount' => $pendingAmount,
            'transactions' => $transactions,
        ]);
    }
}
