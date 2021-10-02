<?php

namespace App\Factory;

use App\Entity\ProductComment;
use App\Repository\ProductCommentRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ProductComment>
 *
 * @method static               ProductComment|Proxy createOne(array $attributes = [])
 * @method static               ProductComment[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static               ProductComment|Proxy find(object|array|mixed $criteria)
 * @method static               ProductComment|Proxy findOrCreate(array $attributes)
 * @method static               ProductComment|Proxy first(string $sortedField = 'id')
 * @method static               ProductComment|Proxy last(string $sortedField = 'id')
 * @method static               ProductComment|Proxy random(array $attributes = [])
 * @method static               ProductComment|Proxy randomOrCreate(array $attributes = [])
 * @method static               ProductComment[]|Proxy[] all()
 * @method static               ProductComment[]|Proxy[] findBy(array $attributes)
 * @method static               ProductComment[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static               ProductComment[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static               ProductCommentRepository|RepositoryProxy repository()
 * @method ProductComment|Proxy create(array|callable $attributes = [])
 */
final class ProductCommentFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'author' => self::faker()->userName(),
            'comment' => self::faker()->realText(140),
            'date' => self::faker()->dateTimeBetween('-2 years'),
            'note' => self::faker()->numberBetween(0, 5),
            'product' => ProductFactory::random(),
        ];
    }

    protected static function getClass(): string
    {
        return ProductComment::class;
    }
}
