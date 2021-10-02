<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\ProductCommentFactory;
use App\Factory\ProductFactory;
use App\Factory\ProductVariantFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        CategoryFactory::new()->createMany(5);
        ProductFactory::new()->createMany(20);

        ProductVariantFactory::createMany(50, function () {
            return ['product' => ProductFactory::random()];
        });

        ProductCommentFactory::createMany(
            100,
            function () {
                return ['product' => ProductFactory::random()];
            }
        );

        $manager->flush();
    }
}
