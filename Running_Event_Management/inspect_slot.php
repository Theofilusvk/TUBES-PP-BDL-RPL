<?php
use Illuminate\Support\Facades\DB;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Checking ms_slotkategori table:\n";
    $columns = DB::select("DESCRIBE ms_slotkategori");
    foreach($columns as $col) {
        echo $col->Field . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
