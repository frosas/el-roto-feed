<?php

use Silex\Application;
use Frosas\ElRoto\Feed;
use Frosas\ElRoto\Cartoons;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/vendor/autoload.php';

$app = new Application;

$app['debug'] = true;

$app->get('feed', function(Application $app) {
    $feed = new Feed(new Cartoons);
    return new Response($feed->build(), 200, array(
        'Content-Type' => 'text/xml' // application/rss+xml'
    ));
});

$app->run();
