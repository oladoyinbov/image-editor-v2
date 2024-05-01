<?php

namespace App\Functions;

function get_file_size(string $file)
{
    $file = filesize($file);
    $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
    $index = 0;
    while ($file >= 1024 && $index < count($sizes) - 1) {
        $file /= 1024;
        $index++;
    }
    return round($file, 2) . ' ' . $sizes[$index];
}