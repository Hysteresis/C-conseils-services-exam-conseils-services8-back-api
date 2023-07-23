<?php


namespace App\DataFixtures;

use App\Entity\Degree;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DegreeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $degrees = [

            1=>[
                'title' => 'C.A.P.',
                'level' => '',
            ],

            2=>[
                'title' => 'Brevet Professionnel',
                'level' => '',
            ],

            3=>[
                'title' => 'Bac',
                'level' => 'Niveau Bac',
            ],

            4=>[
                'title' => 'Bac professionnel',
                'level' => 'Niveau Bac',
            ],

            5=>[
                'title' => 'D.U.T. Diplôme Universitaire de technologie ',
                'level' => 'BAC +2/3',
            ],

            6=>[
                'title' => 'B.T.S. (Brevet de technicien supérieur)',
                'level' => 'BAC +2/3',
            ],

            7=>[
                'title' => 'B.U.T. (Bachelor Universitaire de technologie)',
                'level' => 'BAC +2/3',
            ],

            8=>[
                'title' => 'Licence Professionnelle',
                'level' => 'BAC +3',
            ],

            9=>[
                'title' => 'Master',
                'level' => 'BAC +5',
            ],

            10=>[
                'title' => 'Mastère spécialisé',
                'level' => 'BAC +5/6',
            ],

            11=>[
                'title' => 'Titre Professionnel',
                'level' => 'BAC +2/3',
            ],

            12=>[
                'title' => 'CQP (certificat de qualification professionnelle)',
                'level' => 'BAC +2/3',
            ],

            13=>[
                'title' => 'Autre',
                'level' => 'Autre',
            ],

        ];

        

        foreach($degrees as $key =>$value){
            $degree = new Degree();
            $degree->setTitle($value['title']);
            $degree->setLevel($value['level']);
            $manager->persist($degree);

            // Enregistre la catégorie dans une référence
            $this->addReference('degree_' .$key, $degree);

        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

