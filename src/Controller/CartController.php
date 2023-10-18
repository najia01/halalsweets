<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Symfony\Component\Security\Core\Security;

class CartController extends AbstractController
{
    public function base(CategoryRepository $categoryRepository, Security $security): Response
{
    $categories = $categoryRepository->findAll();
    $userIsLoggedIn = $security->isGranted('ROLE_USER');

    return $this->render('base.html.twig', [
        'categories' => $categories,
        'userIsLoggedIn' => $userIsLoggedIn,
    ]);
}

    #[Route('/add-to-cart/{id}', name: 'add_to_cart')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
