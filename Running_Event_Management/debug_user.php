<?php
use Illuminate\Support\Facades\DB;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = 'KalcerAdmin123@gmail.com';
$user = DB::table('tr_pengguna')->where('Email', $email)->first();

if ($user) {
    echo "User Found: " . $user->NamaLengkap . "\n";
    echo "Role ID (PeranID): " . $user->PeranID . "\n";
    // Check what Role ID 1 is
    $role = DB::table('ms_peran')->where('PeranID', 1)->first();
    echo "Role 1 Name: " . ($role ? $role->NamaPeran : 'Unknown') . "\n";
} else {
    echo "User not found.\n";
}
