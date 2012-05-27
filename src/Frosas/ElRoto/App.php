<?php

namespace Frosas\ElRoto;

use Silex\Application;
use Frosas\ElRoto\Feed;
use Frosas\ElRoto\Strips;
use Symfony\Component\HttpFoundation\Response;

class App extends Application
{
    function __construct()
    {
        parent::__construct();

        $this->get('feed', function(Application $app) {
            $feed = new Feed(new Strips);
            return new Response($feed->build(), 200, array(
                'Content-Type' => 'text/xml' // application/rss+xml'
            ));
        });
    }
}