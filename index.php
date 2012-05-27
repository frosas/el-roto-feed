<?php

use Frosas\ElRoto\App;

require __DIR__ . '/vendor/autoload.php';

$app = new App;
$app['debug'] = true;
$app->run();
