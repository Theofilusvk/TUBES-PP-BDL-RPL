<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$admins = User::where('PeranID', 1)->get();
echo "Total Admins: " . $admins->count() . "\n";
foreach ($admins as $admin) {
    echo "ID: {$admin->PenggunaID} - Name: {$admin->NamaLengkap} - Email: {$admin->Email}\n";
}
