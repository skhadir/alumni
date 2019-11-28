<?php

namespace App\DataFixtures;


use App\Entity\Year;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class YearFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $compteur = 0;

        for($years = date('Y')-10; $years <date('Y')+1; $years++){
            $year = new Year();
            $year->setTitle($years. '/' . ($years+1));
            $manager->persist($year);

            $this->addReference("Year_$compteur", $year);
            $compteur++;
        }

        $manager->flush();
    }


}
