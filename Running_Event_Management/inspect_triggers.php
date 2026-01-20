<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "--- Database Triggers ---\n";

try {
    $triggers = DB::select('SHOW TRIGGERS');
    
    foreach ($triggers as $trigger) {
        echo "\nTrigger Name: " . $trigger->Trigger . "\n";
        echo "Event: " . $trigger->Event . "\n";
        echo "Table: " . $trigger->Table . "\n";
        echo "Timing: " . $trigger->Timing . "\n";
        echo "Statement:\n" . $trigger->Statement . "\n";
        echo "---------------------------------------------------\n";
    }
    
    if (empty($triggers)) {
        echo "No triggers found in the database.\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
