<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductDetailsController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product_details', methods: ['GET'])]
    public function details(int $id): Response
    {
        return $this->render('product_details.html.twig');
    }
}
