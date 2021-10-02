<?php

namespace App\Factory;

use App\Entity\ProductVariant;
use App\Repository\ProductVariantRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ProductVariant>
 *
 * @method static               ProductVariant|Proxy createOne(array $attributes = [])
 * @method static               ProductVariant[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static               ProductVariant|Proxy find(object|array|mixed $criteria)
 * @method static               ProductVariant|Proxy findOrCreate(array $attributes)
 * @method static               ProductVariant|Proxy first(string $sortedField = 'id')
 * @method static               ProductVariant|Proxy last(string $sortedField = 'id')
 * @method static               ProductVariant|Proxy random(array $attributes = [])
 * @method static               ProductVariant|Proxy randomOrCreate(array $attributes = [])
 * @method static               ProductVariant[]|Proxy[] all()
 * @method static               ProductVariant[]|Proxy[] findBy(array $attributes)
 * @method static               ProductVariant[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static               ProductVariant[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static               ProductVariantRepository|RepositoryProxy repository()
 * @method ProductVariant|Proxy create(array|callable $attributes = [])
 */
final class ProductVariantFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'value' => self::faker()->colorName(),
            'qtyInStock' => self::faker()->numberBetween(0, 100),
        ];
    }

    protected static function getClass(): string
    {
        return ProductVariant::class;
    }
}
