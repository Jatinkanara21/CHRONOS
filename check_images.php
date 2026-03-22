<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// 1. Get all image paths from database
$dbWatches = App\Models\Watch::all(['id', 'name', 'image']);
$dbPaths = [];
foreach ($dbWatches as $w) {
    if ($w->image) {
        $dbPaths[] = $w->image;
    }
}

// 2. Get all files on disk
$diskFiles = [];
$dir = storage_path('app/public/watches');
if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $diskFiles[] = "watches/" . $file;
        }
    }
}

$output = "--- DATABASE IMAGE PATHS ---\n";
$output .= implode("\n", array_unique($dbPaths)) . "\n\n";

$output .= "--- DISK FILES (storage/app/public/watches) ---\n";
$output .= implode("\n", $diskFiles) . "\n\n";

// 3. Find matches or discrepancies
$missingOnDisk = array_diff($dbPaths, $diskFiles);
$orphansOnDisk = array_diff($diskFiles, $dbPaths);

$output .= "--- MISSING ON DISK (In DB but not on disk) ---\n";
$output .= implode("\n", $missingOnDisk) . "\n\n";

$output .= "--- ORPHANED ON DISK (On disk but not in DB) ---\n";
$output .= implode("\n", $orphansOnDisk) . "\n\n";

file_put_contents('image_audit.txt', $output);
echo "Audit written to image_audit.txt\n";
