<?php

namespace App\Tests\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\PantherTestCase;

class ProductControllerTest extends PantherTestCase
{
    private AbstractBrowser $client;
    private Crawler $crawler;
    private Product $product;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $repos = static::getContainer()->get(ProductRepository::class);
        $this->product = $repos->findOneBy([]);
        $this->crawler = $this->client->request('GET', sprintf('/product/%d', $this->product->getId()));
    }

    public function testIsDisplaysTheNameAndTheCategoryOfTheProduct(): void
    {
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', $this->product->getName());
        self::assertSelectorTextContains('h2', $this->product->getCategory()->getName());
    }

    public function testIsDisplaysTheDetailsOfTheProduct(): void
    {
        $details = substr($this->product->getDetails(), 0, 20);
        self::assertSelectorTextContains('.content', $details);
        self::assertSelectorAttributeContains('.columns img', 'src', $this->product->getImageUrl());
    }
}
