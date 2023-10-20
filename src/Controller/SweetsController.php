<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\SweetsRepository;
use App\Form\SearchSweetsFormType;
use Symfony\Component\HttpFoundation\Request;

class SweetsController extends AbstractController
{

    #[Route("/category/{id}", name: "category_sweets")]
    public function categorySweets(CategoryRepository $categoryRepository, SweetsRepository $sweetsRepository, $id): Response
    {
        $category = $categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException('La catégorie n\'existe pas.');
        }

        $sweets = $sweetsRepository->findSweetsByCategory($category);

        $categories = $categoryRepository->findAll();

        return $this->render('sweets.html.twig', [
            'sweets' => $sweets,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    #[Route("/search", name: "search")]

    public function searchAction(Request $request, SweetsRepository $sweetsRepository): Response
    {
      
        $query = $request->query->get('query');

        if ($query) {
            $results = $sweetsRepository->findSweetsByName($query);
        } else {
            $results = [];
        }

        return $this->render('sweet/search.html.twig', [
            'results' => $results,
        ]);
    }
}
