<?php

namespace Frosas\ElRoto\Cartoons;

use Frosas\ElRoto\Cartoons\Cartoon\Page;
use Frosas\Misc\Error;

class Feed
{
    private $rss;
    
    function __construct()
    {
        $content = @file_get_contents('http://elpais.com/tag/c/rss/ec7a643a2efd84d02c5948f7a9c86aa7');
        if ($content === false) throw Error::createExceptionFromLast();
        $this->rss = new \SimpleXMLElement($content);
    }
    
    function siteUrl()
    {
        return (string) $this->rss->channel->link;
    }
    
    function lastItem()
    {
        foreach ($this->rss->channel->item as $item) {
            if (preg_match('/El Roto/i', (string) $item->title)) {
                return $item;
            }
        }
    }
}
