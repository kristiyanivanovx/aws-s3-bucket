<?php

function getFilesInDirectory($directory) {
    $files = scandir($directory);
    $fileList = [];

    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $fileList[] = $directory . "/" . $file;
        }
    }

    return $fileList;
}

function uploadFilesInFolder($fileNames, $client, $bucketName) {
    foreach ($fileNames as $fileName) {
        $client->putObject([
            'Bucket' => $bucketName,
            'Key' => $fileName,
            'Body' => fopen($fileName, 'r'),
        ]);
    }
}
