<?php

namespace App\DataFixtures;

use App\Factory\PublisherFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PublisherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        PublisherFactory::createMany(10);
    }
}
