<?php
require __DIR__ . '/../vendor/autoload.php';

use GearmanApp\GearmanClient;

$client = new GearmanClient('127.0.0.1', 4730);

$client->publishJob("testQueue", "low", json_encode(["user" => "test"]));
