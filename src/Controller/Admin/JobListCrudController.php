<?php

namespace App\Controller\Admin;

use App\Entity\JobList;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JobListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobList::class;
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
