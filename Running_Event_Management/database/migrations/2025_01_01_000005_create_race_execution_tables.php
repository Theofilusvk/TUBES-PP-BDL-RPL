<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Detail Race Pack Peserta (BIB & Chip)
        Schema::create('tr_race_pack_detail_peserta', function (Blueprint $table) {
            $table->uuid('detail_id')->primary();
            $table->uuid('pendaftaran_id')->nullable();
            $table->string('nomor_bib', 50)->nullable();
            $table->string('chip_timer_id', 50)->nullable();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('tr_pendaftaran')->cascadeOnDelete();
        });

        // Distribusi/Pengambilan Race Pack
        Schema::create('tr_distribusi', function (Blueprint $table) {
            $table->uuid('distribusi_id')->primary();
            $table->uuid('pendaftaran_id')->nullable();
            $table->uuid('petugas_id')->nullable();
            $table->timestamp('tanggal_pengambilan')->nullable();
            $table->string('status_pengambilan', 50)->nullable();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('tr_pendaftaran')->cascadeOnDelete();
            $table->foreign('petugas_id')->references('pengguna_id')->on('tr_pengguna')->nullOnDelete();
        });

        // Hasil Lomba (Race Result)
        Schema::create('tr_hasil', function (Blueprint $table) {
            $table->uuid('hasil_id')->primary();
            $table->uuid('pendaftaran_id')->nullable();
            $table->time('waktu_finish')->nullable();
            $table->integer('peringkat_umum')->nullable();
            $table->integer('peringkat_kategori')->nullable();
            $table->string('status_hasil', 50)->nullable();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('tr_pendaftaran')->cascadeOnDelete();
        });

        // Peringkat Detail (Kelompok Usia)
        Schema::create('tr_peringkat_kelompok_usia', function (Blueprint $table) {
            $table->id('peringkat_id');
            $table->uuid('hasil_id')->nullable();
            $table->string('kelompok_usia', 50)->nullable();
            $table->integer('peringkat_kelompok')->nullable();

            $table->foreign('hasil_id')->references('hasil_id')->on('tr_hasil')->cascadeOnDelete();
        });

        // Sertifikat
        Schema::create('tr_sertifikat', function (Blueprint $table) {
            $table->uuid('sertifikat_id')->primary();
            $table->uuid('pendaftaran_id')->nullable();
            $table->string('nomor_sertifikat', 100)->nullable();
            $table->string('file_path_pdf', 255)->nullable();
            $table->timestamp('tanggal_generate')->nullable();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('tr_pendaftaran')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_sertifikat');
        Schema::dropIfExists('tr_peringkat_kelompok_usia');
        Schema::dropIfExists('tr_hasil');
        Schema::dropIfExists('tr_distribusi');
        Schema::dropIfExists('tr_race_pack_detail_peserta');
    }
};
