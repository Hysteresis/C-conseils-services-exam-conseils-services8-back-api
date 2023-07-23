<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class DepartmentFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
        // $sujet = new Sujet();
        $faker = faker\Factory::create('fr_FR');

        for($nbDepartments = 1; $nbDepartments <= 101; $nbDepartments++) {
           
        // $manager->persist($product);
            $department = new Department();
            $department->setNumber($faker->departmentNumber);
            $department->setName($faker->departmentName);
            $department->setDepartmentUppercase($faker->departmentName);

            
            

            $this->addReference('department_' .$nbDepartments, $department);

            $manager->persist($department);
        }
    $manager->flush();
}
}
