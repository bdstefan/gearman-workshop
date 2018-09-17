<?php

namespace GearmanApp;

require __DIR__ . '/../vendor/autoload.php';

final class AsyncWorker extends AbstractWorker
{
    /**
     * Register a consumer for your asyncQueue
     */
    protected function registerWorker()
    {
        $this->worker->addFunction($this->server->getAsyncQueue(), function (\GearmanJob $job) {
            echo "Workload is: " . $job->workload() . PHP_EOL;
            $workload = json_decode($job->workload(), true);
            $result   = array_sum($workload['numbers']);
            echo "*Result is: " . $result . PHP_EOL;

            return $result;
        });
    }
}

(new AsyncWorker())->execute();