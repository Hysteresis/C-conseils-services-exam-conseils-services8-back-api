<?php

namespace App\Controller\Admin;

use App\Entity\SalaryCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SalaryCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SalaryCategory::class;
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
