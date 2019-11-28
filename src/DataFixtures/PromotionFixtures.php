<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PromotionFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $degrees = $this->getReferences('Degree');
        $years = $this->getReferences('Year');

        $cpt=0;

        $faker = Factory::create('fr_FR');

        foreach ($degrees as $degree){
            foreach ($years as $year){
                $promotion = new Promotion();
                $promotion ->setStartDate('1 Septembre');
                $promotion ->setEndDate('30 mai');
                $promotion->setDegree($degree);
                $promotion->setYear($year);
                $manager->persist($promotion);
                $this->addReference('Promotion_'.$cpt, $promotion);
                $cpt++;

            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DegreeFixtures::class,
            YearFixtures::class
        ];
    }
}
