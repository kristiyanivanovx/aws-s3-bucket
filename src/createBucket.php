<?php

namespace App;

require '../vendor/autoload.php';

use Config\Config;
use Services\AwsS3Service;
use Services\PrintService;

$bucketName = (new Config())->getBucketName();

$awsS3Service = new AwsS3Service();
$result = $awsS3Service->createBucket($bucketName);

PrintService::print($result);