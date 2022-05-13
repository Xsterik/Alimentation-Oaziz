<?php

namespace App\Controller;

use App\Entity\Micronutrients;
use App\Form\FilterAlimentsType;
use App\Repository\AlimentsRepository;
use App\Services\FilterAliments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {



        return $this->render('home/index.html.twig', [
            'activePage' => 'home',
        ]);
    }
    
}
