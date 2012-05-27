<?php

namespace Frosas\ElRoto;

use Frosas\ElRoto\Cartoons\Cartoon;
use Frosas\ElRoto\Cartoons\Feed as CartoonsFeed;

class Cartoons
{
    private $feed;
    
    function __construct()
    {
        $this->feed = new CartoonsFeed;
    }
    
    function last()
    {
        if ($lastItem = $this->feed->lastItem()) return new Cartoon($lastItem);
    }
    
    function url()
    {
        return $this->feed->siteUrl();
    }
}