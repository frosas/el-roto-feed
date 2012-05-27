<?php

namespace Frosas\ElRoto\Strips;

use Frosas\ElRoto\Strips\Strip\Page;

class Strip
{
    private $page;
    
    function __construct(Page $page)
    {
        $this->page = $page;
    }
    
    function title()
    {
        return $this->page->title();
    }
    
    function url()
    {
        return $this->page->url();
    }
    
    function imageUrl()
    {
        return $this->page->imageUrl();
    }
    
    function created()
    {
        return $this->page->created();
    }
}