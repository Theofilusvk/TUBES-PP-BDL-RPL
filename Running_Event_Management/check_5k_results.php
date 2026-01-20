<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check 5K results with pace
$results = DB::table('tr_hasillomba as h')
    ->join('tr_pendaftaran as p', 'h.PendaftaranID', '=', 'p.PendaftaranID')
    ->join('ms_kategorilomba as k', 'p.KategoriID', '=', 'k.KategoriID')
    ->join('tr_pengguna as u', 'p.PenggunaID', '=', 'u.PenggunaID')
    ->where('k.Jarak', 'LIKE', '%5K%')
    ->where('h.StatusHasil', 'Finish')
    ->select('u.NamaLengkap', 'k.Jarak', 'h.WaktuFinish', 'h.Pace', 'h.PeringkatUmum')
    ->orderBy('h.WaktuFinish', 'asc')
    ->get();

echo "5K Race Results:\n";
echo str_repeat("=", 80) . "\n";
foreach ($results as $result) {
    echo "Runner: {$result->NamaLengkap}\n";
    echo "Distance: {$result->Jarak}\n";
    echo "Time: {$result->WaktuFinish}\n";
    echo "Pace: " . ($result->Pace ?? 'NULL') . "\n";
    echo "Rank: {$result->PeringkatUmum}\n";
    echo str_repeat("-", 80) . "\n";
}

echo "\nTotal 5K results: " . $results->count() . "\n";
