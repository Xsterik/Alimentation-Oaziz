<?php

namespace App\Controller\Admin;

use App\Entity\Micronutrients;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MicronutrientsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Micronutrients::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'Id')->hideOnForm();
        yield TextField::new('name', 'Nom');
        yield AssociationField::new('category', 'Catégorie');
       
    }
}
