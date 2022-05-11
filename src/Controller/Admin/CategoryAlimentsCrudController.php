<?php

namespace App\Controller\Admin;

use App\Entity\CategoryAliments;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryAlimentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryAliments::class;
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
