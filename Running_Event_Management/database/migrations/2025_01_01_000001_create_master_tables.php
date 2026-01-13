<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Peran (Role)
        Schema::create('ms_peran', function (Blueprint $table) {
            $table->id('peran_id');
            $table->string('nama_peran', 50);
            // No timestamps in SQL, but good practice to add? SQL didn't have them. I'll stick to SQL schema strictly unless necessary.
        });

        // Tabel Event
        Schema::create('ms_event', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('nama_event', 100);
            $table->text('deskripsi_event')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('lokasi_event', 255)->nullable();
            $table->string('status_event', 20)->nullable();
        });

        // Tabel Tipe Notifikasi
        Schema::create('ms_tipe_notifikasi', function (Blueprint $table) {
            $table->id('tipe_id');
            $table->string('nama_tipe', 50);
        });

        // Tabel Metode Pembayaran
        Schema::create('ms_metode_pembayaran', function (Blueprint $table) {
            $table->id('metode_id');
            $table->string('nama_metode', 100);
            $table->text('nomor_akun')->nullable();
            $table->string('atas_nama', 150)->nullable();
        });

        // Tabel Item Race Pack (Master Barang)
        Schema::create('ms_race_pack_item', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('nama_item', 100);
            $table->string('deskripsi_item', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_race_pack_item');
        Schema::dropIfExists('ms_metode_pembayaran');
        Schema::dropIfExists('ms_tipe_notifikasi');
        Schema::dropIfExists('ms_event');
        Schema::dropIfExists('ms_peran');
    }
};
