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
        // Add GambarEvent to ms_event table
        if (Schema::hasTable('ms_event')) {
            Schema::table('ms_event', function (Blueprint $table) {
                if (!Schema::hasColumn('ms_event', 'GambarEvent')) {
                    $table->string('GambarEvent', 255)->nullable()->after('StatusEvent');
                }
            });
        }

        // Create total_distances table
        if (!Schema::hasTable('total_distances')) {
            Schema::create('total_distances', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('PenggunaID')->unique(); // Links to tr_pengguna
                $table->decimal('TotalDistance', 10, 2)->default(0);
                $table->timestamp('LastUpdated')->useCurrent();
                
                // Foreign key constraint (optional but recommended if using InnoDB)
                // $table->foreign('PenggunaID')->references('PenggunaID')->on('tr_pengguna')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('total_distances')) {
            Schema::dropIfExists('total_distances');
        }

        if (Schema::hasTable('ms_event')) {
            Schema::table('ms_event', function (Blueprint $table) {
                if (Schema::hasColumn('ms_event', 'GambarEvent')) {
                    $table->dropColumn('GambarEvent');
                }
            });
        }
    }
};
