<?php
namespace App\DataFixtures;

use App\Entity\Ad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AdFixtures extends Fixture implements DependentFixtureInterface

{
    public function load(ObjectManager $manager): void
    {   
        $faker = Faker\Factory ::create('fr_FR');

        for($nbAds = 1; $nbAds <= 100; $nbAds++){
            $employmentContract = $this->getReference('employmentContract_' . $faker->numberBetween(1,7));
            $recruiter = $this->getReference(('recruiter_' . 
            $faker->numberBetween(1,30)));
            $department = $this->getReference('department_' . $faker->numberBetween(1,101));
            $degree = $this->getReference('degree_' . $faker->numberBetween(1,13));
            $town = $this->getReference('town_' . $faker->numberBetween(1,100));
            $salary = $this->getReference('salary_' . $faker->numberBetween(1,100));
            $jobList = $this->getReference('job_' . $faker->numberBetween(1,30));
        // $product = new Product();
        // $manager->persist($product);
            $ad = new Ad();
            $ad->setSlug($faker->slug());
            $ad->setTitle($faker->realText(10));
            $ad->setRecruiter($recruiter);
            $ad->setDegree($degree);
            $ad->setEmploymentContract($employmentContract);
            $ad->setJob($jobList);
            $ad->setSalary($salary);
            $ad->setTown($town);
            $ad->setDescription($faker->realText(400));
            $ad->setNumberAd($faker->numberBetween(20000,100000));
            $ad->setIsVerified($faker->boolean(80));
            $ad->setIsClosed($faker->boolean(20));
            $dateTime = $faker->dateTimeThisMonth();
            $dateTimeImmutable = \DateTimeImmutable::createFromMutable($dateTime);
            $ad->setCreatedAt($dateTimeImmutable);
            $ad->setContractStartDate($faker->dateTimeThisMonth());

            $this->addReference('ad_' .$nbAds, $ad);

            $manager->persist($ad);
        }
            $manager->flush();
        }
    public function getDependencies()
        {
            return[
                EmploymentContractFixtures::class,
                SalaryFixtures::class,
                TownFixtures::class,
                RecruiterFixtures::class,
                JobListFixtures::class,
                DegreeFixtures::class,

                ];
            }
        }

