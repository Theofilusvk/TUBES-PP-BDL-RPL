<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

echo "Checking Table Schema: tr_pendaftaran\n";
$columns = Schema::getColumnListing('tr_pendaftaran');
print_r($columns);

echo "\nAttempting Test Insertion...\n";

try {
    DB::beginTransaction();
    
    // Get a valid user and category first
    $user = DB::table('tr_pengguna')->first();
    $category = DB::table('ms_kategorilomba')->first();
    
    if (!$user || !$category) {
        throw new Exception("Missing dummy user or category data.");
    }
    
    echo "User ID: " . $user->PenggunaID . "\n";
    echo "Category ID: " . $category->KategoriID . "\n";

    $id = DB::table('tr_pendaftaran')->insertGetId([
         'PenggunaID' => $user->PenggunaID,
         'KategoriID' => $category->KategoriID,
         'StatusPendaftaran' => 'Menunggu Pembayaran',
         'TanggalPendaftaran' => now(),
         'NomorBIB' => 'TEST-' . rand(1000,9999)
    ]);
    
    echo "Insert Successful! Created ID: $id\n";
    
    DB::rollback();
    echo "Transaction Rolled Back (Clean State).\n";

} catch (\Exception $e) {
    echo "INSERT FAILED: " . $e->getMessage() . "\n";
}
