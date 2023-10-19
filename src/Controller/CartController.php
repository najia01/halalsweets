<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CartRepository;
use App\Repository\SweetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Cart;


class CartController extends AbstractController
{
    private $cartRepository;
    private $sweetsRepository;
    private $entityManager;

    public function __construct(CartRepository $cartRepository, SweetsRepository $sweetsRepository,EntityManagerInterface $entityManager)
    {
        $this->cartRepository = $cartRepository;
        $this->sweetsRepository = $sweetsRepository;
        $this->entityManager = $entityManager;
    }
 
   
    #[Route('/add-to-cart/{sweetId}', name: 'add_to_cart')]

    public function addToCart(int $sweetId): Response
    {
      
        $sweet = $this->sweetsRepository->find($sweetId);
        if (!$sweet) {
            $this->addFlash('error', 'Le bonbon que vous essayez d\'ajouter n\'existe pas.');
            return $this->redirectToRoute('cart');
        }
        $user = $this->getUser(); // Récupérez l'utilisateur actuellement authentifié
        $cart = $this->cartRepository->findCartByUser($user);
        
        if (!$cart) {
            // Si l'utilisateur n'a pas de panier, créez-en un
            $cart = new Cart();
            $cart->setUserId($this->getUser());
            $cart->setTotal(0);
            $this->entityManager->persist($cart);
        }
        $cart->addItem($sweet);

        $total = 0;
        foreach ($cart->getItems() as $item) {
            $total += $item->getPrice();
        }
    
        $cart->setTotal($total);
    
        $this->entityManager->flush();


        return $this->redirectToRoute('cart');
    }
    
    
 #[Route("/remove-from-cart/{id}", name:"remove_from_cart")]
 
public function removeFromCart(int $id): Response
{
    // Récupérez l'article à supprimer du panier
    $sweet = $this->sweetsRepository->find($id);

    if (!$sweet) {
        $this->addFlash('error', 'L\'article que vous essayez de retirer n\'existe pas.');
            return $this->redirectToRoute('cart');
    }
    
    $cart = $this->cartRepository->findCartByUser($this->getUser());

    if ($cart) {
       
        $cart->removeItem($sweet);
        $this->entityManager->flush();
    }

    return $this->redirectToRoute('cart');
}

    #[Route("/cart", name:"cart")]
     
    public function viewCart(): Response
    {
        $cart = $this->cartRepository->findCartByUser($this->getUser());

        return $this->render('cart/view_cart.html.twig', [
            'cart' => $cart,
        ]);
    }


}

