<?php

namespace App\DataFixtures;

use App\Entity\AnswerAd;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
Use Faker;

class AnswerAdFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory ::create('fr_FR');

        for($nbAnswers = 1; $nbAnswers <= 100; $nbAnswers++){
            $candidate = $this->getReference('candidate_' . $faker->numberBetween(1,150));
            $ad = $this->getReference(('ad_' . 
            $faker->numberBetween(1,100)));
            $answerAd= new AnswerAd();
            $answerAd->setMessage($faker->realText(400));
            $answerAd->setAd($ad);
            $answerAd->setCandidate($candidate);
            $this->addReference('answerAd_' .$nbAnswers, $answerAd);

            $manager->persist($answerAd);
        }
            $manager->flush();
        }
    public function getDependencies()
        {
            return[
                CandidateFixtures::class,
                AdFixtures::class,
                
                ];
            }
        }

