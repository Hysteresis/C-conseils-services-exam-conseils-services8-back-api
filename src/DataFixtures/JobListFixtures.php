<?php

namespace App\DataFixtures;

use App\Entity\JobCategory;
use App\Entity\JobList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class JobListFixtures extends Fixture implements DependentFixtureInterface

{
    public function load(ObjectManager $manager): void
    {
        $jobs = [
            1=>[
                'title' => 'Carreleur/Carreleuse',
            ],
            2=>[
                'title' => 'Charpentier/Charpentière bois',
            ],
            3=>[
                'title' => 'Charpentier/Charpentière métallique',
            ],
            4=>[
                'title' => 'Constructeur/Constructrice en béton armé',
            ],
            5=>[
                'title' => 'Couvreur/Couvreuse',
            ],

            6=>[
                'title' => 'Conducteur/Conductrice de travaux',
            ],
            7=>[
                'title' => 'Electricien/Electricienne',
            ],

            8=>[
                'title' => 'Grutier/Grutière',
            ],

            9=>[
                'title' => 'Maçon/Maçonne',
            ],
            10=>[
                'title' => 'Menuisier/Menuisière',
            ],

            11=>[
                'title' => 'Installateur thermique et climatique',
            ],
            12=>[
                'title' => 'Plâtrier/Plâtrière',
            ],
            13=>[
                'title' => 'Plombier/Plombière',
            ],
            14=>[
                'title' => 'Serrurier - Métallier/Serrurière - Métallière',
            ],
            15=>[
                'title' => 'Constructeur/Conductrice de routes',
            ],
            
            16=>[
                'title' => 'Conducteur/Conductrice de poids lourds',
            ],

            17=>[
                'title' => "Conducteur/Conductrice d'engins",
            ],

            18=>[
                'title' => "Constructeur/Constructrice en ouvrage d'Art",
            ],

            19=>[
                'title' => "Mécanicien/Mécanicienne d'engins de chantier",
            ],

            20=>[
                'title' => 'Monteur/Monteuse de réseaux électriques',
            ],

            21=>[
                'title' => 'Monteur/Monteuse de lignes caténaires',
            ],
            22=>[
                'title' => 'Technicien/Technicienne géomètre topographe',
            ],

            23=>[
                'title' => 'Technicien/Technicienne études, métrés, devis',
            ],

            24=>[
                'title' => 'Technicien/Technicienne qualité, sécurité, environnement (QSE)',
            ],

            25=>[
                'title' => "Chef/Cheffe d'atelier",
            ],

            26=>[
                'title' => 'Chef/ Cheffe de chantier',
            ],

            27=>[
                'title' => 'Conducteur/Conductrice de travaux',
            ],

            28=>[
                'title' => ' BIM manager',
            ],

            29=>[
                'title' => 'Ingénieur/Ingenieure BTP',
            ],

            30=>[
                'title' => 'dessinateur projeteur/dessinatrice projeteuse',
            ],
        
        ];

        $faker = Faker\Factory::create();
        
       
            foreach($jobs as $key =>$value){
                
                $jobCatagory = $this->getReference('jobCategory_' . $faker->numberBetween(1,4));

                $job = new JobList();
                $job->setTitle($value['title']);
                
                $job->setJobcategory($jobCatagory);
                $manager->persist($job);

                // Enregistre la catégorie dans une référence
                $this->addReference('job_' .$key, $job);

        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
    
    public function getDependencies()
{
    return[
        
        JobCategoryFixtures::class,
        
        
    ];
}
}


