<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BrowseCategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_browse_categories', methods: ['GET'])]
    public function browse(CategoryRepository $categoryRepository): Response
    {
        $data = $categoryRepository->findAllWithProductCount();

        return $this->render('browse_categories.html.twig', [
            'categoriesData' => $data,
        ]);
    }
}
