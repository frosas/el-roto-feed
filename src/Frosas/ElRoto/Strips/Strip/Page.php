<?php

namespace Frosas\ElRoto\Strips\Strip;

use Symfony\Component\DomCrawler\Crawler;

class Page
{
    private $feedItem;
    private $crawler;
    
    function __construct(\SimpleXMLElement $feedItem)
    {
        $this->feedItem = $feedItem;
    }
    
    function url()
    {
        return (string) $this->feedItem->link;
    }
    
    function title()
    {
        return $this->crawler()->filter('.article .antetitulo')->text();
    }
    
    function imageUrl()
    {
        return $this->crawler->filter('.article img')->attr('src');
    }
    
    function created()
    {
        return strtotime((string) $this->feedItem->pubDate);
    }
    
    private function crawler()
    {
        if (! $this->crawler) {
            $content = file_get_contents($this->url());
            $this->crawler = new Crawler(null, $this->url());
            $this->crawler->addHtmlContent($content);
        }
        
        return $this->crawler;
    }
}