<?php

namespace Config;

class Config
{
    /**
     * @var string[]
     */
    private array $config;
    private string $bucketName = 'x.bucket.chris.123';

    public function __construct()
    {
        $this->config = [
            'profile' => 'default',
            'region' => 'eu-central-1',
            'version' => 'latest'
        ];
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getBucketName(): string
    {
        return $this->bucketName;
    }
}