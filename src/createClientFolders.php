<?php

namespace App;

use Config\Config;
use Services\AwsS3Service;
use Services\DataService;
use Services\PrintService;

require '../vendor/autoload.php';

$awsS3Service = new AwsS3Service();
$dataService = new DataService();

$clients = $dataService->getClients();
$bucketName = (new Config())->getBucketName();

foreach ($clients as $client) {
    $result = $awsS3Service->createClientFolders($bucketName, $client->id);
    PrintService::print($result);
}
