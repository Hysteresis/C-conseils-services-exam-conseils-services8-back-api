<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Department;
use App\Entity\Town;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('town', EntityType::class, [
            'class' => Town::class,
            'placeholder' => 'Choisir sa ville',
            // 'autocomplete' => true,
        ])
            // ->add('slug')
            // ->add('numberAd')
            // ->add('isVerified')
            // ->add('title')
            // ->add('createdAt')
            // ->add('modifiedAt')
            // ->add('isClosed')
            // ->add('contractStartDate')
            // ->add('duration')
            // ->add('description')
            // ->add('town')
            // ->add('salary')
            // ->add('job')
            // ->add('recruiter')
            // ->add('employmentContract')
            // ->add('degree')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
