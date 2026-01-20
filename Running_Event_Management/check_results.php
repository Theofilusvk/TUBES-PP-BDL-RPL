<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check what's in tr_hasillomba
$results = DB::table('tr_hasillomba')
    ->join('tr_pendaftaran', 'tr_hasillomba.PendaftaranID', '=', 'tr_pendaftaran.PendaftaranID')
    ->join('tr_pengguna', 'tr_pendaftaran.PenggunaID', '=', 'tr_pengguna.PenggunaID')
    ->select('tr_pengguna.NamaLengkap', 'tr_hasillomba.*')
    ->limit(5)
    ->get();

echo "Recent Results in Database:\n";
echo str_repeat("=", 80) . "\n";
foreach ($results as $result) {
    echo "Participant: {$result->NamaLengkap}\n";
    echo "Finish Time: {$result->WaktuFinish}\n";
    echo "Pace: " . ($result->Pace ?? 'NULL') . "\n";
    echo "Rank: " . ($result->PeringkatUmum ?? 'NULL') . "\n";
    echo str_repeat("-", 80) . "\n";
}
