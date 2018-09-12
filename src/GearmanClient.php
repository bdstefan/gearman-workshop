<?php

namespace GearmanApp;

class GearmanClient
{
    /** @var \GearmanClient */
    private $client;

    public function __construct(string $host, int $port)
    {
        //$this->client = new \GearmanClient();
        //$this->client->addServer($host, $port);
    }

    public function publishJob(string $queue, string $priority, string $payload)
    {
        //$this->client->doLow($queue, $payload);
        print_r(func_get_args());
    }
}
