<?php

namespace App\Controller\Admin;

use App\Entity\Micronutrients;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MicronutrientsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Micronutrients::class;
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
