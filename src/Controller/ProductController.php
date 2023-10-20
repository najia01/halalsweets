<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SweetsRepository;
use App\Entity\Sweet;
use App\Entity\Category;
use App\Repository\CategoryRepository;

class ProductController extends AbstractController
{

    #[Route('/product/{id}', name: 'product_detail')]
    public function detail($id, SweetsRepository $sweetsRepository, CategoryRepository $categoryRepository): Response
    {
        
        $sweet = $sweetsRepository->findSweetById($id);

        if (!$sweet) {
            throw $this->createNotFoundException('Le bonbon n\'existe pas.');
        }

       
        $categories = $categoryRepository->findAll();

        return $this->render('product/detail.html.twig', [
            'sweet' => $sweet,
            'categories' => $categories,
        ]);
    }
}
