<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SweetsRepository;
use App\Entity\Sweet;

class ProductController extends AbstractController
{

    #[Route('/product/{id}', name: 'product_detail')]
    public function detail($id, SweetsRepository $sweetsRepository): Response
    {
        // Récupérer le bonbon depuis le repository
        $sweet = $sweetsRepository->findSweetById($id);

        if (!$sweet) {
            throw $this->createNotFoundException('Le bonbon n\'existe pas.');
        }

        return $this->render('product/detail.html.twig', [
            'sweet' => $sweet,
        ]);
    }
}
