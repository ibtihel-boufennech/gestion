<?php

namespace App\Controller\Admin;

use App\Entity\Types;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Types::class;
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
