<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/category', name: 'app_category')]
    public function categoryAction(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        if (!empty($categories)) {
          
            return $this->redirectToRoute('category_sweets', ['id' => $categories[0]->getId()]);
        } else {
           
            return $this->redirectToRoute('app_homepage');
        }
    }
    
     #[Route("/", name:"app_homepage")]
     
    public function base(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('base.html.twig', [
            'categories' => $categories,
        ]);
    }
}
