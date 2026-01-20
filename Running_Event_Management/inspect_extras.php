<?php
use Illuminate\Support\Facades\DB;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function describe($table) {
    try {
        echo "\nChecking $table table:\n";
        $columns = DB::select("DESCRIBE $table");
        foreach($columns as $col) {
            echo $col->Field . "\n";
        }
    } catch (\Exception $e) {
        echo "$table not found or error.\n";
    }
}

describe('ms_notifikasi');
describe('tr_pengirimannotifikasi');
describe('ms_resetpasswordtoken');
