<?php

namespace App\Controller\Admin;

use App\Entity\CategoryAliments;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryAlimentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryAliments::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index','Catégories aliments')
        ->setPageTitle('new','Créer nouvelle catégorie aliment')
        ->setPageTitle('edit','Modification catégorie aliment');
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'Id')->hideOnForm();
        yield TextField::new('name', 'Nom');
        
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return parent::configureActions($actions)
    //     ->disable(Action::DETAIL);
    // }
}
