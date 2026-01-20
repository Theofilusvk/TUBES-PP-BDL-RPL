<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$roles = DB::table('ms_peran')->get();
foreach ($roles as $role) {
    echo "ID: " . $role->PeranID . " - Name: " . $role->NamaPeran . "\n";
}
