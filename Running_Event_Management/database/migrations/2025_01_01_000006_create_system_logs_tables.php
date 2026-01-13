<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Master Notifikasi
        Schema::create('ms_notifikasi', function (Blueprint $table) {
            $table->id('notifikasi_id');
            $table->uuid('admin_id')->nullable();
            $table->string('judul_notifikasi', 255)->nullable();
            $table->text('isi_notifikasi')->nullable();
            $table->integer('target_peran_id')->nullable();
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->timestamp('tanggal_diubah')->nullable();

            $table->foreign('admin_id')->references('pengguna_id')->on('tr_pengguna')->nullOnDelete();
        });

        // Pengiriman Notifikasi
        Schema::create('tr_pengiriman_notifikasi', function (Blueprint $table) {
            $table->id('pengiriman_id');
            $table->unsignedBigInteger('notifikasi_id')->nullable();
            $table->uuid('pengguna_id_target')->nullable();
            $table->timestamp('waktu_kirim')->nullable();
            $table->string('status_kirim', 50)->nullable();
            $table->boolean('dibaca')->default(false);

            $table->foreign('notifikasi_id')->references('notifikasi_id')->on('ms_notifikasi')->cascadeOnDelete();
            $table->foreign('pengguna_id_target')->references('pengguna_id')->on('tr_pengguna')->cascadeOnDelete();
        });

        // Log Login
        Schema::create('log_login', function (Blueprint $table) {
            $table->id('log_id');
            $table->uuid('pengguna_id')->nullable();
            $table->timestamp('waktu_login')->useCurrent();
            $table->string('alamat_ip', 45)->nullable();

            $table->foreign('pengguna_id')->references('pengguna_id')->on('tr_pengguna')->nullOnDelete();
        });

        // Log Aktivitas
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id('log_aktivitas_id');
            $table->uuid('pengguna_id')->nullable();
            $table->string('tipe_aktivitas', 100)->nullable();
            $table->text('detail_aktivitas')->nullable();
            $table->timestamp('waktu_aktivitas')->useCurrent();

            $table->foreign('pengguna_id')->references('pengguna_id')->on('tr_pengguna')->nullOnDelete();
        });

        // Log Backup
        Schema::create('log_backup', function (Blueprint $table) {
            $table->id('backup_log_id');
            $table->uuid('admin_id')->nullable();
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->string('tipe_backup', 50)->nullable();
            $table->string('status_backup', 50)->nullable();
            $table->string('lokasi_file_backup', 255)->nullable();

            $table->foreign('admin_id')->references('pengguna_id')->on('tr_pengguna')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_backup');
        Schema::dropIfExists('log_aktivitas');
        Schema::dropIfExists('log_login');
        Schema::dropIfExists('tr_pengiriman_notifikasi');
        Schema::dropIfExists('ms_notifikasi');
    }
};
