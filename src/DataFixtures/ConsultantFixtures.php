<?php

namespace App\DataFixtures;

use App\Entity\Consultant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ConsultantFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $encoder)
    {
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbConsultants = 1; $nbConsultants <= 3; $nbConsultants++){
            $consultant = new Consultant();
            
            $consultant->setFirstname($faker->firstName);
            $consultant->setRoles(['ROLE_USER']);
            $consultant->setLastname($faker->lastName);
            $consultant->setAlias($faker->userName());
            $consultant->setEmail($faker->email());
            $password = "azerty";
            $hashedPassword = $this->encoder->hashPassword($consultant, $password) ;
            $consultant->setPassword($hashedPassword);
            $consultant->setPhoneNumber($faker->phoneNumber());
            $consultant->setIsVerified($faker->boolean());

            $manager->persist($consultant);

            $this->addReference('consultant_' . $nbConsultants, $consultant);
        }
        $manager->flush();
    }
}

