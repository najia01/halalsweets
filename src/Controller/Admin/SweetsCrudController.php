<?php

namespace App\Controller\Admin;

use App\Entity\Sweets;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SweetsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sweets::class;
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
