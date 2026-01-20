<?php
use Illuminate\Support\Facades\DB;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$dbName = env('DB_DATABASE', 'db_sistemmanajemenevent_lari');

echo "Tables referencing tr_pendaftaran:\n";
$refs = DB::select("
    SELECT TABLE_NAME, COLUMN_NAME 
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
    WHERE REFERENCED_TABLE_NAME = 'tr_pendaftaran' 
    AND TABLE_SCHEMA = ?
", [$dbName]);

foreach($refs as $ref) {
    echo "- " . $ref->TABLE_NAME . " (" . $ref->COLUMN_NAME . ")\n";
}

echo "\nTables referencing tr_pengguna:\n";
$refs = DB::select("
    SELECT TABLE_NAME, COLUMN_NAME 
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
    WHERE REFERENCED_TABLE_NAME = 'tr_pengguna' 
    AND TABLE_SCHEMA = ?
", [$dbName]);

foreach($refs as $ref) {
    echo "- " . $ref->TABLE_NAME . " (" . $ref->COLUMN_NAME . ")\n";
}
