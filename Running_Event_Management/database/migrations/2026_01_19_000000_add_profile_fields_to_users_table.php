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
        if (Schema::hasTable('tr_pengguna')) {
            Schema::table('tr_pengguna', function (Blueprint $table) {
                if (!Schema::hasColumn('tr_pengguna', 'Gambar')) {
                    $table->string('Gambar', 255)->nullable()->after('NamaLengkap');
                }
                if (!Schema::hasColumn('tr_pengguna', 'NomorTelepon')) {
                    $table->string('NomorTelepon', 20)->nullable()->after('Email');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('tr_pengguna')) {
            Schema::table('tr_pengguna', function (Blueprint $table) {
                if (Schema::hasColumn('tr_pengguna', 'Gambar')) {
                    $table->dropColumn('Gambar');
                }
                if (Schema::hasColumn('tr_pengguna', 'NomorTelepon')) {
                    $table->dropColumn('NomorTelepon');
                }
            });
        }
    }
};
