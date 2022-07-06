<?php

namespace Services;

use Config\Config;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Aws\Sdk;

class AwsS3Service
{
    private Config $config;
    private Sdk $sdk;
    private S3Client $s3Client;
    private DataService $dataService;

    public function __construct()
    {
        $this->config = new Config();
        $this->sdk = new Sdk($this->config->getConfig());
        $this->s3Client = $this->sdk->createS3();
        $this->dataService = new DataService();
    }

    public function getSdk(): Sdk
    {
        return $this->sdk;
    }

    public function getS3Client(): S3Client
    {
        return $this->s3Client;
    }

    public function putS3Object($bucketName, $key, $body, $acl): void
    {
        $this->getS3Client()->putObject([
            'Bucket' => $bucketName,
            'Key' => $key,
            'Body' => $body,
            'ACL' => $acl
        ]);
    }

    public function createBucket($bucketName): string
    {
        try {
            $this->getS3Client()->createBucket([ 'Bucket' => $bucketName ]);
            return 'Bucket created!';
        } catch (S3Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateClientConfigurations($bucketName, $configuration): string
    {
        try {
            $clientId = $configuration->clientId;
            $clientFolderHash = $this->dataService->getHashedValue($clientId);

            $results = $this->getS3Client()->getPaginator('ListObjects', [
                'Bucket' => $bucketName,
                'Prefix' => $clientFolderHash,
            ]);

            // not optimal - triple foreach, iterating every config for this user / folder
            foreach ($results as $result) {
                if (is_null($result['Contents'])) {
                    return 'Such client (with id ' . $clientId . ') does not exist!';
                }

                foreach ($result['Contents'] as $object) {
                    foreach ($configuration->locales as $locale) {
                        if (str_contains($object['Key'], $locale)) {
                            $key = $object['Key'];
                            $this->putS3Object($bucketName, $key, json_encode($configuration), 'public-read');
                        }
                    }
                }
            }

            return 'Configuration of client with id ' . $clientId . ' was updated in folder ' . $clientFolderHash . '!' . PHP_EOL;
        } catch (S3Exception $e) {
            return $e->getMessage();
        }
    }

    public function createClientConfigurations($bucketName, $configuration, $locale, $configurationIndex): string
    {
        try {
            $clientId = $configuration->clientId;
            $clientFolderHash = $this->dataService->getHashedValue($clientId);
            $configurationFolderName = 'config-' . ($configurationIndex + 1);
            $key = $clientFolderHash . "/" . $configurationFolderName . "/" . $locale . '.json';

            $this->putS3Object($bucketName, $key, json_encode($configuration), 'public-read');

            return 'A folder for (' . $locale . ') locale for client with id ' . $clientId . ' was created in client folder ' . $clientFolderHash . '!' . PHP_EOL;
        } catch (S3Exception $e) {
            return $e->getMessage();
        }
    }

    public function createClientFolders($bucketName, $clientId): string
    {
        try {
            $clientFolderHash = $this->dataService->getHashedValue($clientId);
            $key = $clientFolderHash . "/";

            $this->putS3Object($bucketName, $key, "", 'public-read');

            return 'Client folder (' . $clientFolderHash . ') created for client with id ' . $clientId . '!' . PHP_EOL;
        } catch (S3Exception $e) {
            return $e->getMessage();
        }
    }
}