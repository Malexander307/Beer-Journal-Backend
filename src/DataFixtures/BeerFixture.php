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
            [
                'name' => 'Lager',
                'imageUrl' => 'https://example.com/images/lager.jpg',
                'description' => 'A light, crisp beer that is refreshing and easy to drink.'
            ],
            [
                'name' => 'IPA',
                'imageUrl' => 'https://example.com/images/ipa.jpg',
                'description' => 'A hoppy beer style known for its strong aroma and flavor.'
            ],
            [
                'name' => 'Stout',
                'imageUrl' => 'https://example.com/images/stout.jpg',
                'description' => 'A dark beer with rich flavors of coffee and chocolate.'
            ],
            [
                'name' => 'Pilsner',
                'imageUrl' => 'https://example.com/images/pilsner.jpg',
                'description' => 'A type of pale lager that is refreshing with a slightly bitter taste.'
            ],
            [
                'name' => 'Wheat Beer',
                'imageUrl' => 'https://example.com/images/wheat.jpg',
                'description' => 'A light and cloudy beer that is often fruity and spicy.'
            ],
            [
                'name' => 'Saison',
                'imageUrl' => 'https://example.com/images/saison.jpg',
                'description' => 'A farmhouse ale that is fruity, spicy, and often has a dry finish.'
            ],
            [
                'name' => 'Porter',
                'imageUrl' => 'https://example.com/images/porter.jpg',
                'description' => 'A dark, rich beer with flavors of chocolate, caramel, and coffee.'
            ],
            [
                'name' => 'Amber Ale',
                'imageUrl' => 'https://example.com/images/amber.jpg',
                'description' => 'A balanced beer with a malt-forward taste and a hint of bitterness.'
            ],
            [
                'name' => 'Barleywine',
                'imageUrl' => 'https://example.com/images/barleywine.jpg',
                'description' => 'A strong ale with a high alcohol content and rich, malty flavors.'
            ],
            [
                'name' => 'Belgian Dubbel',
                'imageUrl' => 'https://example.com/images/dubbel.jpg',
                'description' => 'A dark Belgian ale that is malty and slightly sweet, often with fruity notes.'
            ],
        ];

        // Loop through each beer and add it to the database
        foreach ($beers as $beerData) {
            $beer = new Beer();
            $beer->setName($beerData['name']);
            $beer->setImageUrl($beerData['imageUrl']);
            $beer->setDescription($beerData['description']);

            $manager->persist($beer);
        }

        $manager->flush();

        $manager->flush();
    }
}
