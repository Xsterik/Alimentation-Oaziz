<?php

namespace App\Controller;

use App\Entity\Aliments;
use App\Entity\CategoryAliments;
use App\Form\FilterAlimentsType;
use App\Repository\AlimentsRepository;
use App\Repository\CategoryAlimentsRepository;
use App\Services\FilterAliments;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimentsController extends AbstractController
{
    #[Route('/aliment/{page<\d+>?1}', name: 'app_aliments')]
    public function index(int $page, FilterAliments $filterAliments, CategoryAlimentsRepository $categoryAlimentsRepository, Request $request): Response
    {
        $aliments = [];

        $form = $this->createForm(FilterAlimentsType::class);
        $form->handleRequest($request);
        $criteria = [];
        if($request->isMethod('GET') && count($request->query)>0){
        // if($form->isSubmitted() && $form->isValid()){
            // dd('form!');
            $aliments = $filterAliments->getAlimentsFilterFromRequest($request);
            
        }else{
            // dd('noform!');
            $aliments = $filterAliments->getAlimentsDefault();
            
        }
        
        if(array_key_exists('filter_aliments', $request->query->all()) && !empty($request->query->all()['filter_aliments'])){
            
            if($request->query->all()['filter_aliments']['season'] != ''){
                $form['season']->setData($request->query->all()['filter_aliments']['season']);
            }
            if($request->query->all()['filter_aliments']['type'] != ''){
                $cateAliment = $categoryAlimentsRepository->findOneBy(['id'=>$request->query->all()['filter_aliments']['type']]);
                if(!$cateAliment) throw new Exception("cateAliment is null, expected CategoryAliment", 1);
                $form['type']->setData($cateAliment);
            }
            
        }
        

        $micros = $filterAliments->createAndOrderMicronutrimentsArray($aliments);


        return $this->render('aliments/index.html.twig', [
            'activePage' => 'aliment',
            'aliments'=>$aliments,
            'micros'=>$micros,
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/aliment/search', name: 'app_alimentSearch', methods: ['GET'])]
    public function searchAliment(Request $request, AlimentsRepository $alimentsRepository): Response
    {
        if(!$request->query->get('preview'))throw new Exception("request do not have a preview query parameter", 1);
        
        $searchTerm = $request->query->get('search');
        $aliments = $alimentsRepository->findBySearch($searchTerm);

        
        return $this->render('aliments/_searchPreview.html.twig', [
            'activePage' => 'aliment',
            'aliments' => $aliments,
            'search'=>$searchTerm
        ]);
    }



    #[Route('/aliment/{name}', name: 'app_aliment')]
    public function aliment(Aliments $aliment, Request $request, FilterAliments $filterAliments): Response
    {
        $micro = $filterAliments->createAndOrderMicronutrimentsArray([$aliment]);

        return $this->render('aliments/aliment.html.twig', [
            'activePage' => 'home',
            'micro'=>$micro,
            'aliment'=>$aliment,
        ]);
    }


}
