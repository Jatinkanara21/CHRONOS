<?php

function getFiles($dir) {
    if (!is_dir($dir)) return [];
    $files = [];
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            $files = array_merge($files, getFiles($path));
        } else {
            if (pathinfo($path, PATHINFO_EXTENSION) === 'php' && strpos($path, '.blade.php') !== false) {
                $files[] = $path;
            }
        }
    }
    return $files;
}

$dir = "C:\\xampp\\htdocs\\watch_store\\watch_store\\resources\\views";
$bladeFiles = getFiles($dir);

$output = "--- CSRF AUDIT REPORT ---\n";
$missingCount = 0;

foreach ($bladeFiles as $file) {
    $content = file_get_contents($file);
    
    // Find all forms
    if (preg_match_all('/<form\b[^>]*>/i', $content, $matches, PREG_OFFSET_CAPTURE)) {
        foreach ($matches[0] as $match) {
            $formTag = $match[0];
            $formOffset = $match[1];
            
            // Check if it's a POST form
            if (stripos($formTag, 'method="POST"') !== false || stripos($formTag, "method='POST'") !== false) {
                // Look for @csrf within the next 200 characters or until the next form tag
                $subContent = substr($content, $formOffset, 300); // 300 chars usually covers @csrf
                if (stripos($subContent, '@csrf') === false && stripos($subContent, '{{ csrf_field() }}') === false) {
                    $missingCount++;
                    $output .= "File: " . basename($file) . "\n";
                    $output .= "Form Tag: " . $formTag . "\n";
                    $output .= "Missing @csrf!\n\n";
                }
            }
        }
    }
}

$output .= "\nTotal missing @csrf: " . $missingCount . "\n";
file_put_contents('csrf_audit.txt', $output);
echo "Audit written to csrf_audit.txt\n";
