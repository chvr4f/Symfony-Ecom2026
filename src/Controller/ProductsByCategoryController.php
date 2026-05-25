<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsByCategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_products_by_category', methods: ['GET'])]
    public function products(int $id): Response
    {
        return $this->render('products_by_category.html.twig');
    }
}
