<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW v_rekap_keuangan AS
            SELECT 
                p.pembayaran_id,
                p.nominal_bayar,
                p.tanggal_bayar,
                p.status_pembayaran,
                m.nama_metode as metode_pembayaran,
                pd.pendaftaran_id,
                k.nama_kategori,
                e.nama_event,
                u.NamaLengkap as nama_peserta
            FROM tr_pembayaran p
            JOIN tr_pendaftaran pd ON p.pendaftaran_id = pd.pendaftaran_id
            JOIN ms_kategori k ON pd.kategori_id = k.kategori_id
            JOIN ms_event e ON k.event_id = e.event_id
            LEFT JOIN tr_pengguna u ON pd.pengguna_id = u.PenggunaID
            LEFT JOIN ms_metode_pembayaran m ON p.metode_id = m.metode_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS v_rekap_keuangan");
    }
};
