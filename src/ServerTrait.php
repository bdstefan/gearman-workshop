<?php

namespace GearmanApp;

trait ServerTrait
{
    public function getServer()
    {
        $connectionFile = __DIR__ . '/../connection.ini';

        if (!file_exists($connectionFile)) {
            throw new \InvalidArgumentException('Create a file named connection.ini filled with Gearman server info.');
        }

        return parse_ini_file($connectionFile);
    }
}
