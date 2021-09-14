<?php

namespace App\Tests\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\PantherTestCase;

class HomepageControllerTest extends PantherTestCase
{
    private Crawler $crawler;

    public function setUp(): void
    {
        $client = static::createClient();
        $this->crawler = $client->request('GET', '/');
    }

    public function testItSaysWelcome(): void
    {
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Bienvenue !');
    }

    public function testItDisplaysTheFeaturedProducts(): void
    {
        $repos = static::getContainer()->get(ProductRepository::class);
        $featured = $repos->findBy(['featured' => true]);

        self::assertCount(count($featured), $this->crawler->filter('.product'));
    }
}
