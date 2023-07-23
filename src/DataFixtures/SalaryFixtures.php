<?php

namespace App\DataFixtures;

use App\Entity\Salary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SalaryFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {   
        $faker = Faker\Factory ::create('fr_FR');

        for($nbSalaries = 1; $nbSalaries <= 100; $nbSalaries++){
    $salaryCategory = $this->getReference('salaryCategory_' . $faker->numberBetween(1,3));


    $salary = new Salary();
    $salary->setAmount($faker->numberBetween(20000,30000));
    $salary->setSalaryCategory($salaryCategory);
    $this->addReference('salary_' .$nbSalaries, $salary);

    $manager->persist($salary);
}
    $manager->flush();
}
public function getDependencies()
{
    return[
    
        SalaryCategoryFixtures::class,

        ];
    }
}
