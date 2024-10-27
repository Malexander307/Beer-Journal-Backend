<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BeerFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $beers = [
            ['name' => 'Lager', 'imageUrl' => 'https://example.com/images/lager.jpg'],
            ['name' => 'IPA', 'imageUrl' => 'https://example.com/images/ipa.jpg'],
            ['name' => 'Stout', 'imageUrl' => 'https://example.com/images/stout.jpg'],
            ['name' => 'Pilsner', 'imageUrl' => 'https://example.com/images/pilsner.jpg'],
            ['name' => 'Wheat Beer', 'imageUrl' => 'https://example.com/images/wheat.jpg'],
        ];

        // Loop through each beer and add it to the database
        foreach ($beers as $beerData) {
            $beer = new Beer();
            $beer->setName($beerData['name']);
            $beer->setImageUrl($beerData['imageUrl']);

            $manager->persist($beer);
        }

        $manager->flush();

        $manager->flush();
    }
}
