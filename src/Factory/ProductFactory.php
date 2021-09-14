<?php

namespace App\Factory;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Product>
 *
 * @method static        Product|Proxy createOne(array $attributes = [])
 * @method static        Product[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static        Product|Proxy find(object|array|mixed $criteria)
 * @method static        Product|Proxy findOrCreate(array $attributes)
 * @method static        Product|Proxy first(string $sortedField = 'id')
 * @method static        Product|Proxy last(string $sortedField = 'id')
 * @method static        Product|Proxy random(array $attributes = [])
 * @method static        Product|Proxy randomOrCreate(array $attributes = [])
 * @method static        Product[]|Proxy[] all()
 * @method static        Product[]|Proxy[] findBy(array $attributes)
 * @method static        Product[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static        Product[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static        ProductRepository|RepositoryProxy repository()
 * @method Product|Proxy create(array|callable $attributes = [])
 */
final class ProductFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->name(),
            'price' => self::faker()->numberBetween(100, 99999),
            'details' => self::faker()->paragraphs(5, true),
            'imageUrl' => self::faker()->imageUrl(),
            'category' => CategoryFactory::random(),
            'inSale' => self::faker()->boolean(70),
            'featured' => self::faker()->boolean(30),
        ];
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}
