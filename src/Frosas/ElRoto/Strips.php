<?php

namespace Frosas\ElRoto;

use Frosas\ElRoto\Strips\Strip;
use Frosas\ElRoto\Strips\Feed as StripsFeed;

class Strips
{
    private $feed;
    
    function __construct()
    {
        $this->feed = new StripsFeed;
    }
    
    function last()
    {
        if ($page = $this->feed->lastStripPage()) return new Strip($page);
    }
    
    function url()
    {
        return $this->feed->siteUrl();
    }
}