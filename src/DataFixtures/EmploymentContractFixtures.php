<?php

namespace App\DataFixtures;

use App\Entity\EmploymentContract;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EmploymentContractFixtures extends Fixture 
{
    
        public function load(ObjectManager $manager): void
        {
            $contracts = [
                1=>[
                    'title' => 'Contrat à durée indéterminée',
                    'acronym' => 'C.D.I.',

                ],


                2=>[
                    'title' => 'Contrat à durée déterminée',
                    'acronym' => 'C.D.D.',
                ],

                3=>[
                    'title' => 'Contrat de travail temporaire ou Intérim',
                    'acronym' => 'C.T.T.',
                ],
                
                4=>[
                    'title' => "Contrat d'apprentissage",
                    'acronym' => 'Alternance',
                ],
                
                5=>[
                    'title' => 'Contrat de professionnalisation',
                    'acronym' => 'Alternance',
                ],
                
                6=>[
                    'title' => "Contrat unique d'insertion",
                    'acronym' => 'C.U.I.',
                ],

                7=>[
                    'title' => "Stage",
                    'acronym' => 'C.U.I.',
                ],

                8=>[
                    'title' => "Autre",
                    'acronym' => 'Autre',
                ],
            ];
    
            foreach($contracts as $key =>$value){
                $contract = new EmploymentContract();
                $contract->setTitle($value['title']);
                $contract->setAcronym($value['acronym']);
                $manager->persist($contract);
    
                // Enregistre la catégorie dans une référence
                $this->addReference('employmentContract_' .$key, $contract);
    
            }
    
            // $product = new Product();
            // $manager->persist($product);
    
            $manager->flush();
        }
    }
