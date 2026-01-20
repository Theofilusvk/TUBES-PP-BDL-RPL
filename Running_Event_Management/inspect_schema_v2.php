<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "--- tr_pengirimannotifikasi Columns ---\n";
print_r(Schema::getColumnListing('tr_pengirimannotifikasi'));

// Check roles table if exists
if (Schema::hasTable('ms_peran')) {
    echo "\n--- ms_peran Data ---\n";
    $roles = DB::table('ms_peran')->get();
    print_r($roles);
}
