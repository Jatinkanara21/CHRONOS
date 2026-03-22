<?php
$dir = "c:\\xampp\\htdocs\\watch_store\\watch_store\\resources\\views\\admin";

function processDirectory($path) {
    $items = scandir($path);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $completePath = $path . DIRECTORY_SEPARATOR . $item;
        if (is_dir($completePath)) {
            processDirectory($completePath);
        } else {
            if (pathinfo($completePath, PATHINFO_EXTENSION) === 'php' && strpos($completePath, '.blade.php') !== false) {
                $content = file_get_contents($completePath);
                
                // 1. Reduce header text size
                $content = str_replace('display-5', 'fs-2', $content);
                $content = str_replace('display-6', 'fs-3', $content);
                
                // 2. Reduce spacing margin bottom precise fit
                $content = str_replace('align-items-center mb-5', 'align-items-center mb-4', $content);
                
                file_put_contents($completePath, $content);
            }
        }
    }
}

processDirectory($dir);
echo "All admin headers reduced successfully.\n";
