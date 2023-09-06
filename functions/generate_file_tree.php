<?php

function generateFileTree($dir) {
    $result = "<ul>";

    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $filePath = $dir . '/' . $file;
            if (is_dir($filePath)) {
                $result .= "<li><strong>$file</strong>";
                $result .= generateFileTree($filePath); // Recursively generate file tree for subdirectories
                $result .= "</li>";
            } else {
                $result .= "<li>$file</li>";
            }
        }
    }

    $result .= "</ul>";
    return $result;
}