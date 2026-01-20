<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

// Find the target Super Admin
$superAdmin = User::where('Email', 'KalcerAdmin123@gmail.com')->first();

if ($superAdmin) {
    echo "Found Super Admin: {$superAdmin->Email} (ID: {$superAdmin->PenggunaID})\n";
    
    // Demote/Delete others
    $others = User::where('PeranID', 1)->where('PenggunaID', '!=', $superAdmin->PenggunaID)->get();
    foreach ($others as $other) {
        echo "Demoting Admin: {$other->Email} (ID: {$other->PenggunaID}) to Participant\n";
        $other->PeranID = 4; // Demote to Participant
        $other->save();
    }
} else {
    echo "KalcerAdmin123@gmail.com not found! Creating it...\n";
    // Optional: Create if missing, but it should exist.
}
