<?php

namespace App\Controller\Admin;

use App\Entity\CatergoryMicronutrients;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CatergoryMicronutrientsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CatergoryMicronutrients::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index','Catégories micronutriments')
        ->setPageTitle('new','Créer nouvelle catégorie micronutriment')
        ->setPageTitle('edit','Modification catégorie micronutriment');
    }
    
    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'Id')->hideOnForm();
        yield TextField::new('name', 'Nom');
        yield TextEditorField::new('description', 'Description')->onlyOnForms();
        yield TextareaField::new('description', 'Description')->onlyOnDetail()->renderAsHtml();
       
    }
    
}
