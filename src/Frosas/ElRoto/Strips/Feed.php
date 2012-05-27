<?php

namespace Frosas\ElRoto\Strips;

use Frosas\ElRoto\Strips\Strip\Page;

class Feed
{
    private $rss;
    
    function __construct()
    {
        $content = file_get_contents('http://elpais.com/tag/c/rss/ec7a643a2efd84d02c5948f7a9c86aa7');
        $this->rss = new \SimpleXMLElement($content);
    }
    
    function lastStripPage()
    {
        if ($item = $this->lastItem()) return new Page($item);
    }
    
    function siteUrl()
    {
        return (string) $this->rss->channel->link;
    }
    
    private function lastItem()
    {
        foreach ($this->rss->channel->item as $item) {
            if (preg_match('/El Roto/i', (string) $item->title)) {
                return $item;
            }
        }
    }
}