<?php

namespace GearmanApp;

require __DIR__ . '/../vendor/autoload.php';

final class Client
{
    /** @var Server */
    private $server;

    /** @var \GearmanClient */
    private $client;

    public function __construct()
    {
        $this->server = new Server();
        $this->client = new \GearmanClient();
        $this->client->addServer(
            $this->server->getHostname(),
            $this->server->getPort()
        );
    }

    /**
     * Publish an async job, will publish a job and will NOT wait for an answer
     */
    public function produceAsyncJob()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->client->doBackground($this->server->getAsyncQueue(), $this->generateWorkload(3));
        }
    }

    /**
     * Publish a sync job execution will wait until will get an answer from consumer
     */
    public function produceSyncJob()
    {
        for ($i = 0; $i < 5; $i++) {
            $result = $this->client->doHigh($this->server->getSyncQueue(), $this->generateWorkload(3));
            echo "*** Result is: " . $result . PHP_EOL;
        }
    }

    private function generateWorkload(int $itemsNumber): string
    {
        $workload = json_encode(["numbers" => $this->getValues($itemsNumber)]);
        echo "Workload is: " . $workload . PHP_EOL;

        return $workload;
    }

    private function getValues(int $itemsNumber): array
    {
        $numbers = range(1, 10);
        shuffle($numbers);

        return array_slice($numbers, 0, $itemsNumber);
    }
}


$client = new Client();
$client->produceAsyncJob();
$client->produceSyncJob();
