<?php

namespace App\Controller\Admin;

use App\Entity\Aliments;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AlimentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Aliments::class;
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
