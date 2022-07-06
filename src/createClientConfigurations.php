<?php

namespace App;

use Config\Config;
use Services\AwsS3Service;
use Services\DataService;
use Services\PrintService;

require '../vendor/autoload.php';

$awsS3Service = new AwsS3Service();
$dataService = new DataService();

$configurations = $dataService->getConfigurations();
$bucketName = (new Config())->getBucketName();

foreach ($configurations as $configurationIndex => $configuration) {
    foreach ($configuration->locales as $locale) {
        $result = $awsS3Service->createClientConfigurations(
            $bucketName,
            $configuration,
            $locale,
            $configurationIndex);

        PrintService::print($result);
    }
}
