<?php

namespace App\Controller\Admin;

use App\Entity\AnswerAd;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnswerAdCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnswerAd::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
