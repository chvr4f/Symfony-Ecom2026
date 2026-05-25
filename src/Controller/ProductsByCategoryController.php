<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsByCategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_products_by_category', methods: ['GET'])]
    public function products(
        int $id,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
    ): Response {
        $category = $categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException(sprintf('Catégorie #%d introuvable.', $id));
        }

        $products = $productRepository->findByCategory($id);

        return $this->render('products_by_category.html.twig', [
            'category' => $category,
            'products'  => $products,
        ]);
    }
}
