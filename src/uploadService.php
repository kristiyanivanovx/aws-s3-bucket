<?php

require 'vendor/autoload.php';

include 'config.php';
include 'functions.php';

global $config;

$sdk = new Aws\Sdk($config);

$s3Client = $sdk->createS3();

if (!isset($argv[1]) || !isset($argv[2])) {
    die('Please provide the name of the target bucket and the name of the folder to upload!'
        . PHP_EOL .
        'Syntax: php artisan [bucket name] [folder name]');
}

$bucketName = $argv[1];
$folderName = $argv[2];

$results = scandir('.');
$fileIndex = array_search($folderName, $results);
$directoryPath = __DIR__ . '/' . $results[$fileIndex];

$fileNames = getFilesInDirectory($directoryPath);
uploadFilesInFolder($fileNames, $s3Client, $bucketName);
