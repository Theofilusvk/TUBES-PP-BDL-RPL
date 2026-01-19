<?php

use App\Models\Event;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$events = DB::table('ms_event')->get();

echo "Checking Events...\n";
foreach($events as $e) {
    echo "Event: " . $e->NamaEvent . " (ID: $e->EventID)\n";
    $cats = DB::table('ms_kategorilomba')->where('EventID', $e->EventID)->get();
    if ($cats->isEmpty()) {
        echo "  [WARNING] No Categories found!\n";
    } else {
        foreach($cats as $c) {
            echo "  - Category: " . $c->NamaKategori . "\n";
            $slots = DB::table('ms_slotkategori')->where('KategoriID', $c->KategoriID)->get();
            if ($slots->isEmpty()) {
                echo "    [WARNING] No Slots found for this category!\n";
            } else {
                echo "    + Slots: " . $slots->count() . "\n";
            }
        }
    }
    echo "----------------\n";
}
