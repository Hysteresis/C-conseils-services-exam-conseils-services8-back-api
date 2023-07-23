<?php

namespace App\DataFixtures;

use App\Entity\Town;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TownFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbTowns = 1; $nbTowns <= 200; $nbTowns++){
            
            $departmentTown = $this->getReference('department_' . $faker->numberBetween(1,101));
            $town = new Town();
            $town->setName($faker->city());
            $town->setZipCode($faker->postcode());
            $town->setDepartmentTown($departmentTown);
        
        $this->addReference('town_' .$nbTowns, $town);
        
        $manager->persist($town);
        }
        $manager->flush();

    }
        public function getDependencies()
        {
            return[
    
            DepartmentFixtures::class,

        ];
    }
}

