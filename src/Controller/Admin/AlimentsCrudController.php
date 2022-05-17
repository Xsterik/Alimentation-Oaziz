<?php

namespace App\Controller\Admin;

use App\Entity\Aliments;
use App\Entity\Micronutrients;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AlimentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Aliments::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'Id')->hideOnForm();
        yield TextField::new('name', 'Nom');
        yield TextEditorField::new('description', 'Description')->onlyOnForms();
        yield TextareaField::new('description', 'Description')->onlyOnDetail()->renderAsHtml();
        yield ImageField::new('image', 'Image')->setBasePath('uploads/aliments')->setUploadDir('public/uploads/aliments')->setUploadedFileNamePattern('Aliment-[timestamp].[extension]');
        yield NumberField::new('protein', 'Protéines');
        yield NumberField::new('carbohydrate', 'Glucides');
        yield NumberField::new('lipid', 'Lipides');
        $seasons = ['Printemps', 'Été', 'Automne', 'Hiver'];
        yield ChoiceField::new('seasonsToConsume', 'Saisons idéals')->setChoices(array_combine($seasons, $seasons))->allowMultipleChoices()->renderExpanded();
        yield AssociationField::new('categoryAliments', 'Catégorie');

        yield AssociationField::new('micronutrients', 'Micronutriments')
        ->setFormTypeOption('by_reference', false)
        ->setFormTypeOption('query_builder', static function (EntityRepository $er) {
            return $er->createQueryBuilder('m')
                ->orderBy('m.name', 'ASC');
        })
        ->setFormTypeOption('multiple', true)
        ->setFormTypeOption('expanded', true)
        ->setFormTypeOption('group_by', static function($choice, $key, $value){
            // dd($choice, $key, $value, !$choice instanceof Micronutrients);
            if(!$choice instanceof Micronutrients)return null;
            return $choice->getCategory();
        });
        ;
    }
    
}
