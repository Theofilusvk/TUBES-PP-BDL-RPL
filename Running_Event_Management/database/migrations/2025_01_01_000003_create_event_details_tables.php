<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Kategori Lomba
        Schema::create('ms_kategori', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('nama_kategori', 100);
            $table->decimal('jarak', 5, 2)->nullable();
            $table->integer('batas_usia_min')->nullable();
            $table->integer('batas_usia_max')->nullable();

            $table->foreign('event_id')->references('event_id')->on('ms_event')->cascadeOnDelete();
        });

        // Jadwal Event
        Schema::create('ms_jadwal_event', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('jenis_jadwal', 100)->nullable();
            $table->timestamp('waktu_jadwal')->nullable();

            $table->foreign('event_id')->references('event_id')->on('ms_event')->cascadeOnDelete();
        });

        // Media Sosial Event
        Schema::create('ms_media_sosial', function (Blueprint $table) {
            $table->id('media_sosial_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('nama_platform', 50)->nullable();
            $table->string('url_akun', 255)->nullable();

            $table->foreign('event_id')->references('event_id')->on('ms_event')->cascadeOnDelete();
        });

        // Sponsor
        Schema::create('tr_sponsor', function (Blueprint $table) {
            $table->id('sponsor_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('nama_sponsor', 150)->nullable();
            $table->string('tingkat_sponsor', 50)->nullable();
            $table->string('logo_url', 255)->nullable();

            $table->foreign('event_id')->references('event_id')->on('ms_event')->cascadeOnDelete();
        });

        // Biaya Pendaftaran
        Schema::create('ms_biaya', function (Blueprint $table) {
            $table->id('biaya_id');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('periode_pembayaran', 100)->nullable();
            $table->decimal('nominal', 18, 2)->nullable();
            $table->char('mata_uang', 3)->nullable();

            $table->foreign('kategori_id')->references('kategori_id')->on('ms_kategori')->cascadeOnDelete();
        });

        // Slot Kategori (Kuota)
        Schema::create('ms_slot_kategori', function (Blueprint $table) {
            $table->id('slot_id');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->integer('kuota_total')->nullable();
            $table->integer('kuota_terisi')->default(0);

            $table->foreign('kategori_id')->references('kategori_id')->on('ms_kategori')->cascadeOnDelete();
        });

        // Stok Race Pack per Event
        Schema::create('ms_stok_race_pack', function (Blueprint $table) {
            $table->id('stok_id');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('ukuran', 20)->nullable();
            $table->integer('jumlah_stok')->nullable();

            $table->foreign('event_id')->references('event_id')->on('ms_event')->cascadeOnDelete();
            $table->foreign('item_id')->references('item_id')->on('ms_race_pack_item')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_stok_race_pack');
        Schema::dropIfExists('ms_slot_kategori');
        Schema::dropIfExists('ms_biaya');
        Schema::dropIfExists('tr_sponsor');
        Schema::dropIfExists('ms_media_sosial');
        Schema::dropIfExists('ms_jadwal_event');
        Schema::dropIfExists('ms_kategori');
    }
};
