<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BrowseCategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_browse_categories', methods: ['GET'])]
    public function browse(): Response
    {
        return $this->render('browse_categories.html.twig');
    }
}
