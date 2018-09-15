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

    public function publish(string $queue, string $workload)
    {
        echo "\n Workload: " . $workload . "\n";
        echo "\n ->>Result " . $this->client->doHigh($queue, $workload) . "\n";
    }
}

