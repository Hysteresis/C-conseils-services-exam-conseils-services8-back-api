<?php

namespace App\DataFixtures;

use App\Entity\Recruiter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RecruiterFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;

    }
    public function load(ObjectManager $manager): void
    {

    $faker = Faker\Factory::create('fr_FR');
        
        for($nbRecruiters = 1; $nbRecruiters <= 34; $nbRecruiters++) {
            $company = $this->getReference('company_' . $faker->numberBetween(1,30));
        
            $recruiter = new Recruiter();
            $recruiter->setCompany($company);
            $recruiter->setEmail($faker->email);
            $recruiter->setPassword($this->encoder->hashPassword($recruiter,'azerty'));
            $recruiter->setRoles(['ROLE_USER']);
            $recruiter->setFirstname($faker->firstName);
            $recruiter->setLastname($faker->lastName);
            $recruiter->setAlias($faker->userName);
            $recruiter->setPhoneNumber($faker->phoneNumber());
            $recruiter->setIsVerified($faker->boolean());

            $this->addReference('recruiter_' .$nbRecruiters, $recruiter);
            $manager->persist($recruiter);

        } 
        

        $manager->flush();
    }
    public function getDependencies()
{
    return[
        
            CompanyFixtures::class,
        
    ];
}
}
