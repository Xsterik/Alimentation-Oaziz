<?php

namespace App\Controller\Admin;

use App\Entity\Micronutrients;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MicronutrientsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Micronutrients::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index','Micronutriments')
        ->setPageTitle('new','Créer nouveau micronutriment')
        ->setPageTitle('edit','Modification micronutriment');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'Id')->hideOnForm();
        yield TextField::new('name', 'Nom');
        yield TextEditorField::new('description', 'Description')->onlyOnForms();
        yield TextEditorField::new('bienfaits', 'Bienfaits')->onlyOnForms();
        yield TextareaField::new('description', 'Description')->onlyOnDetail()->renderAsHtml();
        yield TextareaField::new('bienfaits', 'Bienfaits')->onlyOnDetail()->renderAsHtml();
        yield AssociationField::new('category', 'Catégorie');
       
    }
}
