<?php

namespace App\DataFixtures;

use App\Entity\Candidate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class CandidateFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;

    }

    public function load(ObjectManager $manager)

    {
    $faker = Faker\Factory::create('fr_FR');

    for($nbCandidates = 1; $nbCandidates <= 150; $nbCandidates++){
        $candidate = new Candidate();
        $candidate->setEmail($faker->email);
        $candidate->setFirstname($faker->firstName);
        $candidate->setLastname($faker->lastName);
        $password = "azerty";
        $hashedPassword = $this->encoder->hashPassword($candidate, $password) ;
        $candidate->setPassword($hashedPassword);
        $candidate->setAlias($faker->userName);
        $candidate->setPhoneNumber("012012012012");
        $candidate->setRoles(['ROLE_USER']);
        $candidate->setIsVerified($faker->boolean());
        $candidate->setDescription($faker->realText(400));
        $candidate->setCv($faker->realText(10));
        $dateTime = $faker->dateTimeThisMonth();
        $dateTimeImmutable = \DateTimeImmutable::createFromMutable($dateTime);
        $candidate->setCreatedAt($dateTimeImmutable);
        $candidate->setImage($faker->imageUrl);
        $candidate->setAddress($faker->address);
    
        // dd($candidate);
        $manager->persist($candidate);

        // Enregistre l'utilisateur dans une référence
        $this->addReference('candidate_' . $nbCandidates, $candidate);
    }
    $manager->flush();
}
}
