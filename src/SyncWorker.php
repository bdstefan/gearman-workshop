<?php

namespace GearmanApp;

require __DIR__ . '/../vendor/autoload.php';

final class SyncWorker extends AbstractWorker
{
    /**
     * Register a consumer for your sync queue
     */
    protected function registerWorker()
    {
        /** Worker for sync job queue */
        $this->worker->addFunction($this->server->getSyncQueue(), function (\GearmanJob $job) {
            $workload = json_decode($job->workload(), true);
            return array_sum($workload['numbers']);
        });
    }
}

(new SyncWorker())->execute();