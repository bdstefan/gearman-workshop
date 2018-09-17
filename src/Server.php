<?php

namespace GearmanApp;

/**
 * Class Server
 * @package GearmanApp
 */
final class Server
{
    /** @var string the host of gearman server */
    private $hostname;

    /** @var int the port of gearman server */
    private $port;

    /** @var string Your own sync queue */
    private $syncQueue;

    /** @var string Your own async queue */
    private $asyncQueue;

    public function __construct()
    {
        $connectionFile = __DIR__ . '/../connection.ini';

        if (!file_exists($connectionFile)) {
            throw new \InvalidArgumentException('Create a file named connection.ini filled with Gearman server info.');
        }

        $server = parse_ini_file($connectionFile);

        $this->hostname   = $server['hostname'];
        $this->port       = $server['port'];
        $this->asyncQueue = $server['asyncQueue'];
        $this->syncQueue  = $server['syncQueue'];
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getSyncQueue(): string
    {
        return $this->syncQueue;
    }

    /**
     * @return string
     */
    public function getAsyncQueue(): string
    {
        return $this->asyncQueue;
    }
}
