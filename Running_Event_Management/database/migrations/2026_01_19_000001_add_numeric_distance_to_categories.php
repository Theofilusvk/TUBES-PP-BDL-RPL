<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('ms_kategorilomba')) {
            Schema::table('ms_kategorilomba', function (Blueprint $table) {
                if (!Schema::hasColumn('ms_kategorilomba', 'JarakKM')) {
                    $table->decimal('JarakKM', 8, 2)->nullable()->after('Jarak');
                }
            });

            // Convert existing data
            DB::statement("UPDATE ms_kategorilomba SET JarakKM = 5.00 WHERE Jarak LIKE '%5K%'");
            DB::statement("UPDATE ms_kategorilomba SET JarakKM = 10.00 WHERE Jarak LIKE '%10K%'");
            DB::statement("UPDATE ms_kategorilomba SET JarakKM = 21.0975 WHERE Jarak LIKE '%21K%'");
            DB::statement("UPDATE ms_kategorilomba SET JarakKM = 25.00 WHERE Jarak LIKE '%25K%'");
            DB::statement("UPDATE ms_kategorilomba SET JarakKM = 42.195 WHERE Jarak LIKE '%42K%'");
            DB::statement("UPDATE ms_kategorilomba SET JarakKM = 50.00 WHERE Jarak LIKE '%50K%'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('ms_kategorilomba')) {
            Schema::table('ms_kategorilomba', function (Blueprint $table) {
                if (Schema::hasColumn('ms_kategorilomba', 'JarakKM')) {
                    $table->dropColumn('JarakKM');
                }
            });
        }
    }
};
