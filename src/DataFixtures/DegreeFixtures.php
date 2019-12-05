<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class DegreeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $degrees = [
            'TP Developpeur Web',
            'TP Web Designer',
            'TP TAI',
            'TP Electricien'
        ];

        $faker = Factory::create('fr_FR');

        foreach($degrees as $index => $degreeName){

            $degree = new Degree();
            $degree->setName($degreeName);
            $degree->setRepository($faker->url);
            $manager->persist($degree);

            $this->addReference('Degree_'.$index, $degree);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
