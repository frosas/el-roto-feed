<?php

namespace Frosas\ElRoto\Cartoons;

use Frosas\ElRoto\Cartoons\Cartoon\Page;

class Cartoon
{
    private $feedItem;
    private $page;
    
    function __construct(\SimpleXMLElement $feedItem)
    {
        $this->feedItem = $feedItem;
        $this->page = new Page($this->url());
    }
    
    function url()
    {
        return (string) $this->feedItem->link;
    }
    
    function title()
    {
        $title = $this->page->title();
        $date = date('d/m/Y', $this->created());
        return $title ? "$title ($date)" : $date;
    }
    
    function imageUrl()
    {
        return $this->page->imageUrl();
    }
    
    function created()
    {
        return strtotime((string) $this->feedItem->pubDate);
    }
}