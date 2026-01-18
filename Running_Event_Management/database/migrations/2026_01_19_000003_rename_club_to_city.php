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
                if (Schema::hasColumn('tr_pengguna', 'Komunitas')) {
                    $table->renameColumn('Komunitas', 'Kota');
                } else if (!Schema::hasColumn('tr_pengguna', 'Kota')) {
                    $table->string('Kota', 100)->nullable()->after('NomorTelepon');
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
                if (Schema::hasColumn('tr_pengguna', 'Kota')) {
                    $table->renameColumn('Kota', 'Komunitas');
                }
            });
        }
    }
};
