<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// 1. Get all disk files
$filesOnDisk = [];
$dir = storage_path('app/public/watches');
if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $filesOnDisk[] = "watches/" . $file;
        }
    }
}

if (empty($filesOnDisk)) {
    echo "No files found on disk to assign.\n";
    exit;
}

// 2. Get all watches
$watches = App\Models\Watch::all();
$fileCount = count($filesOnDisk);

echo "Found " . count($watches) . " watches and " . $fileCount . " files on disk.\n";

$assigned = 0;
foreach ($watches as $index => $watch) {
    if ($index < $fileCount) {
        $watch->image = $filesOnDisk[$index];
        $watch->save();
        $assigned++;
    } else {
        // Wrap around if not enough files
        $watch->image = $filesOnDisk[$index % $fileCount];
        $watch->save();
        $assigned++;
    }
}

echo "Successfully updated " . $assigned . " watches with valid image paths from disk.\n";
