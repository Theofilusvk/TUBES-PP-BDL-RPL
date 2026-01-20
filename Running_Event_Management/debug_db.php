<?php
use Illuminate\Support\Facades\DB;
use App\Models\Event;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $latestEvent = DB::table('ms_event')->orderBy('EventID', 'desc')->first();
    echo "Latest Event: " . ($latestEvent ? $latestEvent->NamaEvent . " (ID: " . $latestEvent->EventID . ")" : "None") . "\n";
    
    $count = DB::table('ms_event')->count();
    echo "Total Events: " . $count . "\n";

    // check specific event named by user if possible? User didn't specify name but I can see if a new one appeared.
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
