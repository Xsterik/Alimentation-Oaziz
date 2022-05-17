<?php

namespace App\Controller;

use App\Entity\CatergoryMicronutrients;
use App\Entity\Micronutrients;
use App\Repository\CatergoryMicronutrientsRepository;
use App\Repository\MicronutrientsRepository;
use App\Services\FilterAliments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicronutrientsController extends AbstractController
{


    #[Route('/micronutriment', name: 'app_micronutrientsType')]
    public function index(CatergoryMicronutrientsRepository $microsCateRep, FilterAliments $filterAliments): Response
    {
        $cateMicronutrients = $microsCateRep->findAll();
        $micronutrients = [];
        foreach ($cateMicronutrients as $key => $value) {
            $micronutrients = array_merge($micronutrients, $filterAliments->getMicronutrientsAsArray($value->getMicronutrients()->getValues()));
        }
        // $micronutrients = $microsCateRep->findAll();
        // $micros = $filterAliments->getMicronutrientsAsArray($micronutrients);

        return $this->render('micronutrients/index.html.twig', [
            'activePage' => 'micro',
            'micronutrients'=>$cateMicronutrients,
            'micros'=>$micronutrients
        ]);
    }


    #[Route('/micronutriment/categorie/{name}', name: 'app_micronutrients')]
    public function microType(CatergoryMicronutrients $catMicronutrient, FilterAliments $filterAliments, MicronutrientsRepository $micronutrientsRepository): Response
    {
        $micronutrients = $micronutrientsRepository->findBy(['category'=>$catMicronutrient->getId()]);
        $micro = $filterAliments->getMicronutrientsAsArray($micronutrients);
        return $this->render('micronutrients/micros.html.twig', [
            'activePage' => 'micro',
            'catMicronutrient'=>$catMicronutrient,
            'micronutrient'=>$micro
        ]);
    }

    #[Route('/micronutriment/{name}', name: 'app_micronutrient')]
    public function micro(Micronutrients $micronutrient): Response
    {

        return $this->render('micronutrients/micro.html.twig', [
            'activePage' => 'micro',
            'micronutrient'=>$micronutrient
        ]);
    }
}
