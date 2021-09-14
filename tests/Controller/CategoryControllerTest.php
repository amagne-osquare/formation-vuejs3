<?php

namespace App\Tests\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\PantherTestCase;

class CategoryControllerTest extends PantherTestCase
{
    private AbstractBrowser $client;
    private Crawler $crawler;
    private Category $category;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $repos = static::getContainer()->get(CategoryRepository::class);
        $this->category = $repos->findOneBy([]);
        $this->crawler = $this->client->request('GET', sprintf('/category/%d', $this->category->getId()));
    }

    public function testIsDisplaysTheNameOfTheCategory(): void
    {
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', $this->category->getName());
    }

    public function testIsDisplaysTheDescriptionOfTheCategory(): void
    {
        self::assertSelectorExists('.notification.is-primary');
    }

    public function testItDisplaysTheProducts(): void
    {
        $repos = static::getContainer()->get(ProductRepository::class);
        $products = $repos->findBy(['category' => $this->category]);

        self::assertCount(count($products), $this->crawler->filter('.product'));

        if (0 === count($products)) {
            return;
        }

        $product = $products[0];
        $this->client->clickLink($product->getName());
        self::assertRouteSame('product', ['id' => $product->getId()]);
    }
}
