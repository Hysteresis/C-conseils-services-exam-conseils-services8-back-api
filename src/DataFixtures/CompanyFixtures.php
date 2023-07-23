<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory ::create('fr_FR');
        for($nbFactories = 1; $nbFactories <= 30; $nbFactories++){
            $company = new Company();
            $company->setName($faker->company());
            $company->setSlug($faker->slug());
            $company->setImage($faker->imageUrl($width = 640, $height = 480));
            $company->setSiret($faker->siret());
            $company->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
            $company->setAddress($faker->address());

            $this->addReference('company_' . $nbFactories, $company);
            $manager->persist($company);
            



        // $product = new Product();
        // $manager->persist($product);

        }
            $manager->flush();
    }
}
