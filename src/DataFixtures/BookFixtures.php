<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // TODO : Créer une fixtures pour les livres, après avoir lancer la fixture principale
        // Les auteurs font partis d'une autre collection : à remplir en même temps ?

        // TODO : ajouter IBAN sur livres (propriété)

        $manager->flush();
    }
}
