<?php

namespace App\DataFixtures;

use App\Entity\JobCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jobCategories = [
            1=>[
                'title' => 'Secteur du bâtiment',
            ],
            2=>[
                'title' => 'Secteur des travaux publics',
            ],
            3=>[
                'title' => 'Secteur technique et de conception',
            ],
            4=>[
                'title' => "Secteur lié à l'encadrement de chantier et à la gestion d'entreprise",
            ],
            
        
        ];

        foreach($jobCategories as $key =>$value){
            $jobCategory = new JobCategory();
            $jobCategory->setTitle($value['title']);
            // Enregistre la catégorie dans une référence
            $this->addReference('jobCategory_' .$key, $jobCategory);
            $manager->persist($jobCategory);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

