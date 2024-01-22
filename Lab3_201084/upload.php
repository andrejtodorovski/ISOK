<?php
$uploadDirectory = 'upload/';

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $temp = explode('.', $fileName);
    $fileExt = strtolower(end($temp));
    if ($fileExt === 'txt') {

        if ($fileError === 0) {
            if ($fileSize <= 300000) {
                if (file_exists($uploadDirectory . $fileName)) {
                    echo "File already exists.";
                } else {
                    $fileDestination = $uploadDirectory . $fileName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo "Upload successful";
                }
            } else {
                echo "Your file is too large.";
            }
        } else {
            echo "There was an error uploading your file.";
        }
    } else {
        echo "You cannot upload files of this type.";
    }
} else {
    echo "No file selected.";
}

