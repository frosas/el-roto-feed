<?php

namespace Frosas\ElRoto\Strips\Strip;

use Symfony\Component\DomCrawler\Crawler;

class Page
{
    private $crawler;
    
    function __construct($url)
    {
        $content = file_get_contents($url);
        $this->crawler = new Crawler(null, $url);
        $this->crawler->addHtmlContent($content);
    }
    
    function title()
    {
        return $this->crawler->filter('.article .antetitulo')->text();
    }
    
    function imageUrl()
    {
        return $this->crawler->filter('.article img')->attr('src');
    }
}