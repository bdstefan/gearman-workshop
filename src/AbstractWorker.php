<?php

namespace GearmanApp;

require __DIR__ . '/../vendor/autoload.php';

abstract class AbstractWorker
{
    /** @var Server */
    protected $server;

    /** @var \GearmanWorker */
    protected $worker;

    public function __construct()
    {
        $this->server = new Server();
        $this->worker = new \GearmanWorker();
        $this->worker->addServer(
            $this->server->getHostname(),
            $this->server->getPort()
        );

        $this->registerWorker();
    }

    public function execute(): void
    {
        while ($this->worker->work());
    }

    abstract protected function registerWorker();
}
