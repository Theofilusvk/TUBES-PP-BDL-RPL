<?php
use Illuminate\Support\Facades\DB;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Checking tr_peserta columns:\n";
try {
    $columns = DB::select('DESCRIBE tr_peserta');
    foreach($columns as $col) {
        echo $col->Field . "\n";
    }
} catch (\Exception $e) {
    echo "tr_peserta not found or error: " . $e->getMessage() . "\n";
}

echo "\nChecking tr_logaktivitassistem columns:\n";
try {
    $columns = DB::select('DESCRIBE tr_logaktivitassistem');
    foreach($columns as $col) {
        echo $col->Field . "\n";
    }
} catch (\Exception $e) {
    echo "tr_log error: " . $e->getMessage() . "\n";
}
