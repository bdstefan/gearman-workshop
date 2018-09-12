<?php
require __DIR__ . '/../vendor/autoload.php';

use GearmanApp\Client;

$client = new Client();

$client->publishBackground("testQueueNew", json_encode(["user" => "test"]));
