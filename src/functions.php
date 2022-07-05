<?php

function getFilesInDirectory($directory) {
    $files = scandir($directory);
    $filesList = [];

    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $filesList[] = $directory . "/" . $file;
        }
    }

    return $filesList;
}

function uploadFilesInFolder($fileFullNames, $client, $bucketName) {
    foreach ($fileFullNames as $fileFullName) {
        $filePathExploded = explode('/', $fileFullName);
        $fileName = $filePathExploded[count($filePathExploded) - 1];

        $client->putObject([
            'Bucket' => $bucketName,
            'Key' => $fileName,
            'Body' => fopen($fileFullName, 'r'),
        ]);
    }
}
