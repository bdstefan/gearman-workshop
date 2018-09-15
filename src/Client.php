<?php

namespace GearmanApp;

class Client implements ServerQueue
{
    use ServerTrait;

    /** @var \GearmanClient */
    private $client;

    public function __construct()
    {
        $server = $this->getServer();
        $this->client = new \GearmanClient();
        $this->client->addServer($server['hostname'], $server['port']);
    }

    public function publishBackground(string $queue, string $workload)
    {
        $this->client->doBackground($queue, $workload);
        $this->client->doLowBackground($queue, $workload);
        $this->client->doHighBackground($queue, $workload);
    }

    public function publish(string $queue, string $payload)
    {
        echo $this->client->doHigh($queue, $payload);
    }
}

