<?php

namespace App;

use Config\Config;
use Services\AwsS3Service;
use Services\DataService;
use Services\PrintService;

require '../vendor/autoload.php';

$awsS3Service = new AwsS3Service();
$dataService = new DataService();

$configuration = $dataService->getUpdatedConfiguration();
$bucketName = (new Config())->getBucketName();

$result = $awsS3Service->updateClientConfigurations($bucketName, $configuration[0]);

PrintService::print($result);
