<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductDetailsController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product_details', methods: ['GET'])]
    public function details(int $id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException(sprintf('Produit #%d introuvable.', $id));
        }

        return $this->render('product_details.html.twig', [
            'product' => $product,
        ]);
    }
}
