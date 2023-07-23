<?php

namespace App\Controller\Admin;

use App\Entity\EmploymentContract;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmploymentContractCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EmploymentContract::class;
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
