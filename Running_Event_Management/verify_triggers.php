<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$triggers = DB::select('SHOW TRIGGERS');
echo "Active Database Triggers:\n";
echo str_repeat("=", 50) . "\n";
foreach ($triggers as $trigger) {
    echo "Trigger: {$trigger->Trigger}\n";
    echo "Event: {$trigger->Event} {$trigger->Timing}\n";
    echo "Table: {$trigger->Table}\n";
    echo str_repeat("-", 50) . "\n";
}
