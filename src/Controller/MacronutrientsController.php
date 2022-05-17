<?php

namespace App\Controller;

use App\Entity\Micronutrients;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MacronutrientsController extends AbstractController
{
    #[Route('/macronutriment', name: 'app_macronutrients')]
    public function index(): Response
    {
        $macronutrients = [
            'proteine'=>'Protéines',
            'glucide'=>'Glucides',
            'lipide'=>'Lipides',
        ];

        return $this->render('macronutrients/index.html.twig', [
            'activePage' => 'macro',
            'macronutrients'=>$macronutrients
        ]);
    }


    #[Route('/macronutriment/{name}', name: 'app_macronutrient')]
    public function macro($name): Response
    {
        if(!in_array($name, ["proteine","lipide","glucide"])) throw $this->createNotFoundException(sprintf('The macronutrient given was not expected, "%s" given, "proteine" or "lipide" or "glucide" expected',$name));

        return $this->render('macronutrients/'.$name.'.html.twig', [
            'activePage' => 'macro',
            'macronutrient'=>$name
        ]);
    }
}
