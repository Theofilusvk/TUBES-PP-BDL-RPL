<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Pengguna (User)
        Schema::create('tr_pengguna', function (Blueprint $table) {
            $table->uuid('pengguna_id')->primary();
            $table->unsignedBigInteger('peran_id')->nullable();
            $table->string('username', 100);
            $table->string('email', 150)->unique();
            $table->string('password_hash', 255);
            $table->string('nama_lengkap', 150)->nullable();
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->string('status_akun', 20)->nullable();

            $table->foreign('peran_id')->references('peran_id')->on('ms_peran')->nullOnDelete();
        });

        // Tabel Token (Reset Password/Verifikasi)
        Schema::create('tr_token', function (Blueprint $table) {
            $table->uuid('token_id')->primary();
            $table->uuid('pengguna_id')->nullable();
            $table->string('token_hash', 255)->nullable();
            $table->timestamp('waktu_kedaluwarsa')->nullable();
            $table->boolean('digunakan')->default(false);

            $table->foreign('pengguna_id')->references('pengguna_id')->on('tr_pengguna')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tr_token');
        Schema::dropIfExists('tr_pengguna');
    }
};
