<?php

namespace Frosas\ElRoto;

class Feed
{
    private $cartoons;
    
    function __construct(Cartoons $cartoons)
    {
        $this->cartoons = $cartoons;
    }
    
    function build()
    {
        $feed = new \SimpleXMLElement('<rss />');
        $feed['version'] = '2.0';
        
        $channel = $feed->addChild('channel');
        $channel->addChild('title', "El Roto");
        $channel->addChild('description', "Las viñetas de El Roto en El País");
        $channel->addChild('link', $this->cartoons->url());
        
        if ($last = $this->cartoons->last()) {
            $item = $channel->addChild('item');
            $item->addChild('title', $last->title());
            $item->addChild('link', $last->url());
            $item->addChild('guid', $last->url())->addAttribute('isPermaLink', 'true');
            $item->addChild('description', '<img src="' . htmlspecialchars($last->imageUrl()) . '">');
            $item->addChild('pubDate', date('r', $last->created()));
        }
        
        return $feed->asXML();        
    }
}