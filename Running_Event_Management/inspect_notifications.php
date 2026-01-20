<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

// Inspect ms_notifikasi
echo "--- ms_notifikasi Columns ---\n";
$columns = Schema::getColumnListing('ms_notifikasi');
foreach ($columns as $column) {
    echo "- $column\n";
}

// Inspect tr_pengirimannotifikasi
echo "\n--- tr_pengirimannotifikasi Columns ---\n";
$columnsSender = Schema::getColumnListing('tr_pengirimannotifikasi');
foreach ($columnsSender as $column) {
    echo "- $column\n";
}

// Sample Data
echo "\n--- Sample Data (ms_notifikasi) ---\n";
$sample = DB::table('ms_notifikasi')->first();
print_r($sample);
