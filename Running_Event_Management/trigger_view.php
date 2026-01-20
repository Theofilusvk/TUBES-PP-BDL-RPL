<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

// Mock Auth
Auth::loginUsingId(1);

echo "--- Rendering View ---\n";
try {
    $view = View::make('layouts.dashboard')->render();
    echo "Render Success (Length: " . strlen($view) . ")\n";
} catch (\Exception $e) {
    echo "Render Failed: " . $e->getMessage() . "\n";
}
