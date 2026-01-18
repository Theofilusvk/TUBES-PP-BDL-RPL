<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Path to the legacy SQL file
        $sqlPath = base_path('../AddDB/db_sistemmanajemenevent_lari.sql');

        if (!File::exists($sqlPath)) {
            // Fallback for different path structures if needed, or error out
            throw new Exception("SQL file not found at: {$sqlPath}");
        }

        // Read SQL file
        $sql = File::get($sqlPath);

        // Remove DELIMITER commands (mysql client specific)
        $sql = preg_replace('/^\s*DELIMITER\s+.*\s*$/m', '', $sql);
        
        // Replace $$ with ; (assuming $$ was the custom delimiter)
        $sql = str_replace('$$', ';', $sql);

        // Execute the cleaned SQL
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op for now as this is a master import
    }
};
