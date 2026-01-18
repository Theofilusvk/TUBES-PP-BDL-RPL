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
        // Add Komunitas to tr_pengguna
        if (Schema::hasTable('tr_pengguna')) {
            Schema::table('tr_pengguna', function (Blueprint $table) {
                if (!Schema::hasColumn('tr_pengguna', 'Komunitas')) {
                    $table->string('Komunitas', 100)->nullable()->after('NomorTelepon');
                }
            });
        }

        // Add NomorBIB to tr_pendaftaran
        if (Schema::hasTable('tr_pendaftaran')) {
            Schema::table('tr_pendaftaran', function (Blueprint $table) {
                if (!Schema::hasColumn('tr_pendaftaran', 'NomorBIB')) {
                    $table->string('NomorBIB', 20)->nullable()->after('KategoriID');
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
                if (Schema::hasColumn('tr_pengguna', 'Komunitas')) {
                    $table->dropColumn('Komunitas');
                }
            });
        }

        if (Schema::hasTable('tr_pendaftaran')) {
            Schema::table('tr_pendaftaran', function (Blueprint $table) {
                if (Schema::hasColumn('tr_pendaftaran', 'NomorBIB')) {
                    $table->dropColumn('NomorBIB');
                }
            });
        }
    }
};
