<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SweetsRepository;

class HomepageController extends AbstractController
{

    #[Route('/', name: 'app_page')]
    public function home(SweetsRepository $sweetsRepository)
    {
        $featuredSweets = $sweetsRepository->findFeaturedSweets(3); 
    
        return $this->render('homepage.html.twig', [
            'featuredSweets' => $featuredSweets,
        ]);
    }
    
}
