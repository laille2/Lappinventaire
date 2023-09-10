<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // TODO : Créer une fixture principale avec un user global, des collections associées

        $globalUser = new User();
        $globalUser->setRoles([]);

        $manager->flush();
    }
}
