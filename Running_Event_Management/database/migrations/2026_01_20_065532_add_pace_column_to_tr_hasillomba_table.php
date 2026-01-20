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
        Schema::table('tr_hasillomba', function (Blueprint $table) {
            $table->string('Pace', 50)->nullable()->after('WaktuFinish');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_hasillomba', function (Blueprint $table) {
            $table->dropColumn('Pace');
        });
    }
};
