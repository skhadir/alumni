<?php

namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

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

        foreach($degrees as $index => $degreeName){

            $degree = new Degree();
            $degree->setName($degreeName);
            $manager->persist($degree);

            $this->addReference('Degree_'.$index, $degree);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
