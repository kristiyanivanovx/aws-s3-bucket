<?php

require 'vendor/autoload.php';

use Aws\S3\Exception\S3Exception;

include 'config.php';

global $config;

$sdk = new Aws\Sdk($config);

$s3Client = $sdk->createS3();

if (!isset($argv[1])) {
    die('Please provide unique name for the bucket to create!' . PHP_EOL . 'Syntax: php createBucketService.php [bucket name]');
}

$bucketName = $argv[1];

try {
    $s3Client->createBucket(['Bucket' => $bucketName]);
    die('Bucket created!');
} catch (S3Exception $e) {
    echo $e->getMessage();
}