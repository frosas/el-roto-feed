<?php

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/vendor/autoload.php';

$app = new Silex\Application;

$app['debug'] = true;

function lastElRotoUrl()
{
    $content = file_get_contents('http://elpais.com/tag/c/rss/ec7a643a2efd84d02c5948f7a9c86aa7');
    $element = new SimpleXMLElement($content);

    foreach ($element->channel->item as $item) {
        if (preg_match('/El Roto/i', (string) $item->title)) {
            return (string) $item->link;
        }
    }
}

function elRoto($url)
{
    $content = file_get_contents($url);
    
    $crawler = new Crawler(null, $url);
    $crawler->addHtmlContent($content);
    
    $data = array();
    $data['url'] = $url;
    $data['title'] = $crawler->filter('.article .antetitulo')->text();
    $data['image_url'] = $crawler->filter('.article img')->attr('src');
    
    return $data;
}

function feed(array $elRoto)
{
    $feed = new SimpleXMLElement('<rss />');
    $feed['version'] = '2.0';
    
    $channel = $feed->addChild('channel');
    $channel->addChild('title', "El Roto");
    $channel->addChild('description', "Las viñetas de El Roto en El País");
    $channel->addChild('link', 'http://elpais.com/tag/c/ec7a643a2efd84d02c5948f7a9c86aa7');
    
    $item = $channel->addChild('item');
    $item->addChild('title', $elRoto['title']);
    $item->addChild('link', $elRoto['url']);
    $item->addChild('guid', $elRoto['url'])->addAttribute('isPermaLink', 'true');
    $item->addChild('description', '<img src="' . htmlspecialchars($elRoto['image_url']) . '">');
    $item->addChild('pubDate', date('r'));
    
    return $feed->asXML();
}

$app->get('feed', function(Silex\Application $app) {
    $url = lastElRotoUrl();
    if (! $url) throw new Exception;
    $elRoto = elRoto($url);
    $feed = feed($elRoto);
    return new Response($feed, 200, array('Content-Type' => 'text/xml' /* application/rss+xml' */));
});

$app->run();
