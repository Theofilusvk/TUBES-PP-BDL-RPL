<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminFinancialController extends Controller
{
    public function index()
    {
        // Calculate Totals using the View
        $totalRevenue = DB::table('v_rekap_keuangan')
            ->where('status_pembayaran', 'PAID') // Assuming 'PAID' is the success status
            ->sum('nominal_bayar');

        // Net Profit (Mock logic: 70% of Revenue)
        $netProfit = $totalRevenue * 0.7;

        $pendingAmount = DB::table('v_rekap_keuangan')
            ->where('status_pembayaran', 'PENDING')
            ->sum('nominal_bayar');

        // List of recent transactions
        $transactions = DB::table('v_rekap_keuangan')
            ->orderBy('tanggal_bayar', 'desc')
            ->limit(50)
            ->get();

        return view('admin.financial', [
            'totalRevenue' => $totalRevenue,
            'netProfit' => $netProfit,
            'pendingAmount' => $pendingAmount,
            'transactions' => $transactions,
        ]);
    }
}
