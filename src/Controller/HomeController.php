<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
            
            // 'fakeArticles'=> $numFakeArticles,
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function admin(){
        // $hashPass = $passwordHasher->hash('bcrypt', $pass);
        // $hashPass = $passwordHasher->hashPassword();
        // hash_algos()

        // return $this->json($hashPass);
    
        return $this->render('home/index.html.twig', [
            'activePage' => 'admin',
            
            // 'fakeArticles'=> $numFakeArticles,
        ]);
    }
    // #[Route('/hashPassword/{pass}', name: 'app_hash')]
    // public function hash($pass, UserPasswordHasherInterface $passwordHasher): Response
    // {
    //     // $hashPass = $passwordHasher->hash('bcrypt', $pass);
    //     // $hashPass = $passwordHasher->hashPassword();
    //     // hash_algos()

    //     // return $this->json($hashPass);
    
    //     return $this->json(hash_algos());
    // }
}
