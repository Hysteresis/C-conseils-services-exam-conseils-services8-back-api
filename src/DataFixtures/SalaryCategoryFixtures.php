<?php

namespace App\DataFixtures;


use App\Entity\SalaryCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SalaryCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $salariesCat = [

            1=>[
                'type' => 'Annuel',
            ],

            2=>[
                'type' => 'Mensuel',
            ],

            3=>[
                'type' => 'Horaire',
                
            ],

            
        ];

        

        foreach($salariesCat as $key =>$value){
            $salaryCategory = new SalaryCategory();
            $salaryCategory->setType($value['type']);
            // Enregistre la catégorie dans une référence
            $manager->persist($salaryCategory);
            $this->addReference('salaryCategory_' .$key, $salaryCategory);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
