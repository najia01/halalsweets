<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\CartRepository;
use App\Entity\Sweets;

class OrderController extends AbstractController
{

    private $cartRepository;
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository, CartRepository $cartRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->cartRepository = $cartRepository;
    }

    #[Route('/order/validate', name: 'order_validate')]
    public function validate(): Response
    {
        // Vérifiez si le client est authentifié
        if (!$this->getUser()) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour valider la commande.');
        }

        $categories = $this->categoryRepository->findAll();
        $cart = $this->cartRepository->findCartByUser($this->getUser());

        if (!$cart) {
            // ajouter redirection plus tard 

        }
        $totalAmount = 0;
        $sweets = [];

        foreach ($cart->getItems() as $item) {
            $sweets[] = $item;
            $totalAmount += $item->getPrice();
        }
        // Récupére détails de  commande 
        $orderDetails = [
            'sweets' => $sweets,
            'totalAmount' => $totalAmount,

        ];

        return $this->render('order/confirmation.html.twig', [
            'categories' => $categories,
            'orderDetails' => $orderDetails,
        ]);
    }
}
