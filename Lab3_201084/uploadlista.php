<?php

$uploadDirectory = 'upload/';

if (is_dir($uploadDirectory)) {
    if ($dh = opendir($uploadDirectory)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                echo "file name: " . $file . "<br>";
            }
        }
        closedir($dh);
    }
} else {
    echo "Upload directory does not exist.";
}