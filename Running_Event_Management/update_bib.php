<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// 1. Create or Update Sequence Table
if (!Schema::hasTable('tr_bib_sequence')) {
    Schema::create('tr_bib_sequence', function (Blueprint $table) {
        $table->id();
        $table->integer('EventID');
        $table->integer('KategoriID');
        $table->integer('LastSequence')->default(0);
        $table->timestamps();
        $table->unique(['EventID', 'KategoriID']);
    });
    echo "Created table tr_bib_sequence\n";
} else {
    echo "Table tr_bib_sequence exists\n";
}

// 2. Ensure tr_pendaftaran has NomorBIB
if (!Schema::hasColumn('tr_pendaftaran', 'NomorBIB')) {
    Schema::table('tr_pendaftaran', function (Blueprint $table) {
        $table->string('NomorBIB', 50)->nullable()->after('StatusPendaftaran');
    });
    echo "Added NomorBIB to tr_pendaftaran\n";
} else {
    echo "tr_pendaftaran already has NomorBIB column\n";
}
