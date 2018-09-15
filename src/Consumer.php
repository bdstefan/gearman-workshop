<?php
require __DIR__ . '/../vendor/autoload.php';

use GearmanApp\Worker;

(new Worker())->execute();
