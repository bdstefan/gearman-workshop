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
        $this->client->publish(Client::SYNC_QUEUE, json_encode(["user" => "this is sync workload"]));
    }
}

$producer = new Producer();
$producer->produceAsyncJob();
$producer->produceSyncJob();
die;