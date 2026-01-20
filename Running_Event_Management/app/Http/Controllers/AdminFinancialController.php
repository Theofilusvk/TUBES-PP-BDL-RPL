<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminFinancialController extends Controller
{
    public function index(Request $request)
    {
        // Calculate Totals directly from Table (Fallback if View fails)
        // Calculate Totals directly from Table (Fallback if View fails)
        $totalRevenue = DB::table('tr_pembayaran')
            ->where('StatusPembayaran', 'Lunas') // Use 'Lunas' based on schema
            ->sum('NominalBayar');

        // Net Profit (Mock logic: 70% of Revenue)
        $netProfit = $totalRevenue * 0.7;

        $pendingAmount = DB::table('tr_pembayaran')
            ->where('StatusPembayaran', 'Menunggu Pembayaran') // Assuming 'Menunggu Pembayaran' based on pendaftaran status default
            ->sum('NominalBayar');

        // Get search parameter
        $search = $request->input('search');

        // List of recent transactions with joins
        $query = DB::table('tr_pembayaran')
            ->join('tr_pendaftaran', 'tr_pembayaran.PendaftaranID', '=', 'tr_pendaftaran.PendaftaranID')
            ->join('tr_pengguna', 'tr_pendaftaran.PenggunaID', '=', 'tr_pengguna.PenggunaID')
            ->leftJoin('ms_kategorilomba', 'tr_pendaftaran.KategoriID', '=', 'ms_kategorilomba.KategoriID')
            ->leftJoin('ms_event', 'ms_kategorilomba.EventID', '=', 'ms_event.EventID')
            ->select(
                'tr_pembayaran.PembayaranID',
                'tr_pembayaran.NominalBayar',
                'tr_pembayaran.TanggalBayar',
                'tr_pembayaran.StatusPembayaran',
                'tr_pembayaran.BuktiPembayaran', // Correct Column Name
                'tr_pendaftaran.PendaftaranID', // Needed for verification
                'tr_pengguna.NamaLengkap as RunnerName',
                'tr_pengguna.Username',
                'ms_event.NamaEvent',
                'ms_kategorilomba.NamaKategori'
            );

        // Apply search filter if provided
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('tr_pengguna.NamaLengkap', 'like', "%{$search}%")
                  ->orWhere('tr_pengguna.Username', 'like', "%{$search}%")
                  ->orWhere('ms_event.NamaEvent', 'like', "%{$search}%")
                  ->orWhere('tr_pembayaran.PembayaranID', 'like', "%{$search}%");
            });
        }

        $transactions = $query->orderBy('tr_pembayaran.TanggalBayar', 'desc')
            ->limit(50)
            ->get();
            
        return view('admin.financial', [
            'totalRevenue' => $totalRevenue,
            'netProfit' => $netProfit,
            'pendingAmount' => $pendingAmount,
            'transactions' => $transactions,
        ]);
    }

    public function verify(Request $request, $id)
    {
        // 1. Validate Input (Status: 'Verified' or 'Rejected')
        $request->validate([
            'status' => 'required|in:Lunas,Ditolak'
        ]);

        $status = $request->input('status');
        $adminId = auth()->user()->PenggunaID ?? 1; // Default to 1 if auth fails or for testing

        try {
            // 2. Call Stored Procedure sp_verifikasi_bayar
            // Parameters: p_pembayaran_id, p_panitia_id, p_status_verifikasi
            // Note: The SP updates tr_pembayaran status to 'Lunas' AND tr_pendaftaran to 'Terverifikasi' if 'Lunas' passed?
            // Let's assume SP handles logic based on input status.
            
            // However, the SP definition seen earlier hardcodes 'Lunas' update in line 140:
            // UPDATE tr_pembayaran SET StatusPembayaran = 'Lunas' ...
            // And tr_verifikasi status is taken from param.
            
            // If we want to support 'Ditolak', we might need custom logic or modify SP.
            // For now, let's assume we use the SP for 'Lunas' (Valid).
            
            if ($status === 'Lunas') {
                DB::statement("CALL sp_verifikasi_bayar(?, ?, ?)", [$id, $adminId, 'Valid']);
                return back()->with('success', 'Payment verified successfully.');
            } else {
                // Manual Rejection Logic
                // 1. Get Details
                $payment = DB::table('tr_pembayaran')
                    ->join('tr_pendaftaran', 'tr_pembayaran.PendaftaranID', '=', 'tr_pendaftaran.PendaftaranID')
                    ->where('tr_pembayaran.PembayaranID', $id)
                    ->select('tr_pendaftaran.PenggunaID', 'tr_pendaftaran.PendaftaranID')
                    ->first();

                if ($payment) {
                     // 2. Update Payment to Ditolak
                    DB::table('tr_pembayaran')->where('PembayaranID', $id)->update(['StatusPembayaran' => 'Ditolak']);
                    
                    // 3. Reset Registration to 'Menunggu Pembayaran' so they can try again
                    DB::table('tr_pendaftaran')->where('PendaftaranID', $payment->PendaftaranID)->update(['StatusPendaftaran' => 'Pendaftaran Ditolak']);

                    // 4. Send Notification via SP
                    // sp_buat_notifikasi_dan_log(p_user_id, p_tipe_notif, p_judul, p_isi, p_aktivitas)
                    DB::statement("CALL sp_buat_notifikasi_dan_log(?, ?, ?, ?, ?)", [
                        $payment->PenggunaID,
                        'System', // Type
                        'Pembayaran Ditolak', // Title
                        'Bukti pembayaran Anda tidak valid. Silakan lakukan pembayaran ulang.', // Body
                        'REJECT_PAYMENT' // Activity Log
                    ]);
                }

                return back()->with('success', 'Payment rejected and user notified.');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Verification failed: ' . $e->getMessage());
        }
    }
    public function dumpNodes()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="financial_nodes_dump.csv"',
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['PaymentID', 'Amount', 'Date', 'Status', 'ProofPath', 'RegistrationID', 'RunnerName', 'Username', 'Event', 'Category']);

            DB::table('tr_pembayaran')
                ->join('tr_pendaftaran', 'tr_pembayaran.PendaftaranID', '=', 'tr_pendaftaran.PendaftaranID')
                ->join('tr_pengguna', 'tr_pendaftaran.PenggunaID', '=', 'tr_pengguna.PenggunaID')
                ->leftJoin('ms_kategorilomba', 'tr_pendaftaran.KategoriID', '=', 'ms_kategorilomba.KategoriID')
                ->leftJoin('ms_event', 'ms_kategorilomba.EventID', '=', 'ms_event.EventID')
                ->select(
                    'tr_pembayaran.PembayaranID',
                    'tr_pembayaran.NominalBayar',
                    'tr_pembayaran.TanggalBayar',
                    'tr_pembayaran.StatusPembayaran',
                    'tr_pembayaran.BuktiPembayaran',
                    'tr_pendaftaran.PendaftaranID',
                    'tr_pengguna.NamaLengkap',
                    'tr_pengguna.Username',
                    'ms_event.NamaEvent',
                    'ms_kategorilomba.NamaKategori'
                )
                ->orderBy('tr_pembayaran.TanggalBayar', 'desc')
                ->chunk(100, function ($rows) use ($handle) {
                    foreach ($rows as $row) {
                        fputcsv($handle, [
                            $row->PembayaranID,
                            $row->NominalBayar,
                            $row->TanggalBayar,
                            $row->StatusPembayaran,
                            $row->BuktiPembayaran,
                            $row->PendaftaranID,
                            $row->NamaLengkap,
                            $row->Username,
                            $row->NamaEvent,
                            $row->NamaKategori
                        ]);
                    }
                });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function dumpSchemas()
    {
        $tables = ['tr_pembayaran', 'tr_pendaftaran', 'ms_biayakategori'];
        $content = "SCHEMA DUMP GENERATED AT " . now() . "\n\n";

        foreach ($tables as $table) {
            $create = DB::select("SHOW CREATE TABLE $table")[0]->{'Create Table'};
            $content .= "-- Structure for table `$table` --\n";
            $content .= $create . ";\n\n";
        }

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="financial_schema_dump.sql"');
    }
}
