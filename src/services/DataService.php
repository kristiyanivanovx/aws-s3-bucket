<?php

namespace Services;

class DataService
{
    private array $clients;
    private array $configurations;
    private array $updatedConfiguration;

    public function __construct()
    {
        $this->clients = json_decode(
        '[{"id": 8,"email": "test@test.de"},{"id": 9,"email": "chris@chris.bg"}]');

        $this->updatedConfiguration = json_decode(
        '[{
                 "clientId": 8,
                 "locales": [
                   "en_US",
                   "bg_BG"
                 ],
                 "otherData": [
                   "something else => updated data, 123"
                 ]
              }]');

        $this->configurations = json_decode(
     '[{
              "clientId": 8,
              "locales": [
                "en_US",
                "bg_BG"
              ],
              "otherData": [
                "something else"
              ]
            },
            {
              "clientId": 8,
              "locales": [
                "ro_RO",
                "de_DE"
              ],
              "description": "config"
            },
            {
              "clientId": 9,
              "locales": [
                "it_IT",
                "tr_TR"
              ],
              "type": "file" 
            }]');
    }

    public function getClients()
    {
        return $this->clients;
    }

    public function getConfigurations()
    {
        return $this->configurations;
    }

    public function getUpdatedConfiguration()
    {
        return $this->updatedConfiguration;
    }

    public function getHashedValue($data): string
    {
        return hash('SHA256', $data);
    }
}