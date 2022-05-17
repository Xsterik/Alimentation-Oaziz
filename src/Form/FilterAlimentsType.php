<?php

namespace App\Form;

use App\Entity\CategoryAliments;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterAlimentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('name', SearchType::class,[
            //     'label'=> 'Chercher un nom',
            //     'required'=>false
            // ])

            // ->add('nbrAlimentsMax', ChoiceType::class,[
            //     'label'=> 'Choisir le nombre d\'aliment max par page',
            //     'choices' => [
            //         'Tous les aliments'=>'all',
            //         '20 max'=>20,
            //         '50 max'=>50,
            //         '100 max'=>100
            //     ],
                
            //     'required'=>false
            // ])
            
            ->add('type', EntityType::class,[
                'label'=> 'Choisir une catégorie : ',
                'class' => CategoryAliments::class,
                'choice_label' => 'name',
                'placeholder'=>'Pas de catégorie d\'aliment choisi',
                // 'default_label'=> 'test',

                'required'=>false
            ])
            ->add('season', ChoiceType::class,[
                'label'=> 'Choisir une saison : ',
                'choices' => [
                    'Printemps'=>'Printemps',
                    'Été'=>'Été',
                    'Automne'=>'Automne',
                    'Hiver'=>'Hiver'
                ],
                // 'multiple'=>true,
                'placeholder'=>'Pas de saison choisi',
                'required'=>false
            ])
            ->add('submit', SubmitType::class,[
                'label'=> 'Filtrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
