<?php
use Illuminate\Support\Facades\DB;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Dropping faulty trigger trg_backup_pendaftaran_deleted...\n";
    DB::unprepared("DROP TRIGGER IF EXISTS trg_backup_pendaftaran_deleted");
    echo "Trigger dropped successfully.\n";
} catch (\Exception $e) {
    echo "Error dropping trigger: " . $e->getMessage() . "\n";
}
