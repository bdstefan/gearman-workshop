<?php

namespace GearmanApp;

class Worker implements ServerQueue
{
    use ServerTrait;

    /** @var \GearmanWorker */
    private $worker;

    public function __construct()
    {
        $server = $this->getServer();
        $this->worker = new \GearmanWorker();
        $this->worker->addServer($server['hostname'], $server['port']);
        $this->registerWorkers();
    }

    public function execute()
    {
        $this->worker->work();
    }

    private function registerWorkers()
    {
        $this->worker->addFunction(static::ASYNC_QUEUE, function (\GearmanJob $job) {
            print_r($job->workload()). "\n";
        });

        $this->worker->addFunction(static::SYNC_QUEUE, function (\GearmanJob $job) {
            return $job->workload();
        });
    }
}
