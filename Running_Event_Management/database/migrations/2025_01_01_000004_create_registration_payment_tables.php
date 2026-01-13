<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pendaftaran Utama
        Schema::create('tr_pendaftaran', function (Blueprint $table) {
            $table->uuid('pendaftaran_id')->primary();
            $table->uuid('pengguna_id')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->timestamp('tanggal_pendaftaran')->useCurrent();
            $table->string('status_pendaftaran', 50)->nullable();

            $table->foreign('pengguna_id')->references('pengguna_id')->on('tr_pengguna')->cascadeOnDelete();
            $table->foreign('kategori_id')->references('kategori_id')->on('ms_kategori')->cascadeOnDelete();
        });

        // Detail Data Peserta
        Schema::create('tr_detail_data_peserta', function (Blueprint $table) {
            $table->uuid('detail_data_id')->primary();
            $table->uuid('pendaftaran_id')->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('golongan_darah', 5)->nullable();
            $table->string('nama_kontak_darurat', 150)->nullable();
            $table->string('nomor_kontak_darurat', 20)->nullable();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('tr_pendaftaran')->cascadeOnDelete();
        });

        // Dokumen Pendukung
        Schema::create('ms_dokumen_pendukung', function (Blueprint $table) {
            $table->id('dokumen_id');
            $table->uuid('pendaftaran_id')->nullable();
            $table->string('nama_dokumen', 100)->nullable();
            $table->string('file_path', 255)->nullable();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('tr_pendaftaran')->cascadeOnDelete();
        });

        // Pilihan Tambahan Peserta
        Schema::create('tr_detail_pilihan_peserta', function (Blueprint $table) {
            $table->uuid('pilihan_id')->primary();
            $table->uuid('pendaftaran_id')->nullable();
            $table->string('jenis_pilihan', 50)->nullable();
            $table->string('nilai_pilihan', 50)->nullable();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('tr_pendaftaran')->cascadeOnDelete();
        });

        // Pembayaran
        Schema::create('tr_pembayaran', function (Blueprint $table) {
            $table->uuid('pembayaran_id')->primary();
            $table->uuid('pendaftaran_id')->nullable();
            $table->unsignedBigInteger('metode_id')->nullable();
            $table->decimal('nominal_bayar', 18, 2)->nullable();
            $table->timestamp('tanggal_bayar')->nullable();
            $table->string('bukti_pembayaran_url', 255)->nullable();
            $table->string('status_pembayaran', 50)->nullable();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('tr_pendaftaran')->cascadeOnDelete();
            $table->foreign('metode_id')->references('metode_id')->on('ms_metode_pembayaran')->nullOnDelete();
        });

        // Verifikasi Pembayaran (Oleh Panitia)
        Schema::create('tr_verifikasi', function (Blueprint $table) {
            $table->uuid('verifikasi_id')->primary();
            $table->uuid('pembayaran_id')->nullable();
            $table->uuid('panitia_id')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->string('status_verifikasi', 50)->nullable();
            $table->text('catatan_verifikasi')->nullable();

            $table->foreign('pembayaran_id')->references('pembayaran_id')->on('tr_pembayaran')->cascadeOnDelete();
            $table->foreign('panitia_id')->references('pengguna_id')->on('tr_pengguna')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_verifikasi');
        Schema::dropIfExists('tr_pembayaran');
        Schema::dropIfExists('tr_detail_pilihan_peserta');
        Schema::dropIfExists('ms_dokumen_pendukung');
        Schema::dropIfExists('tr_detail_data_peserta');
        Schema::dropIfExists('tr_pendaftaran');
    }
};
