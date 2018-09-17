<?php

namespace GearmanApp;

require __DIR__ . '/../vendor/autoload.php';

class Worker
{
    /** @var Server */
    private $server;

    /** @var \GearmanWorker */
    private $worker;

    public function __construct()
    {
        $this->server = new Server();
        $this->worker = new \GearmanWorker();
        $this->worker->addServer(
            $this->server->getHostname(),
            $this->server->getPort()
        );
        $this->registerWorkers();
    }

    public function execute()
    {
        $this->worker->work();
    }

    private function registerWorkers()
    {
        /** Worker for async job queue */
        $this->worker->addFunction($this->server->getSyncQueue(), function (\GearmanJob $job) {
            echo "Workload is: " . $job->workload() . PHP_EOL;
            $workload = json_decode($job->workload(), true);
            $result   = array_sum($workload['numbers']);
            echo "*Result is: " . $result . PHP_EOL;

            return $result;
        });

        /** Worker for sync job queue */
        $this->worker->addFunction($this->server->getAsyncQueue(), function (\GearmanJob $job) {
            $workload = json_decode($job->workload(), true);
            return array_sum($workload['numbers']);
        });
    }
}

(new Worker())->execute();