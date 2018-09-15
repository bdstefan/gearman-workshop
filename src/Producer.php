<?php

require __DIR__ . '/../vendor/autoload.php';

use GearmanApp\Client;

class Producer
{
    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function produceAsyncJob()
    {
        $this->client->publishBackground(Client::ASYNC_QUEUE, json_encode(["user" => "test"]));
    }

    public function produceSyncJob()
    {
        for ($i = 0; $i < 100; $i++) {
            $this->client->publish(Client::SYNC_QUEUE, json_encode(["numbers" => $this->getValues(3)]));
        }
    }

    private function getValues(int $length): array
    {
        $numbers = range(1, 10);
        shuffle($numbers);
        return array_slice($numbers, 0, $length);
    }
}

$producer = new Producer();
$producer->produceAsyncJob();
$producer->produceSyncJob();