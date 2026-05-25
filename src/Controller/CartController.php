<?php

namespace App\Controller;

use App\Cart\CartHandler;
use App\Cart\CartInterface;
use App\Cart\CartItem;
use App\Cart\SessionCart;
use App\Cart\ApiCart;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    public function cart(
        #[Autowire(service: SessionCart::class)] CartInterface $cartStrategy
    ): Response {
        $cart = $cartStrategy->getCart('default_cart');

        return $this->render('cart.html.twig', [
            'cart' => $cart
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add', methods: ['POST'])]
    public function add(
        int $id,
        Request $request,
        ProductRepository $productRepository,
        #[Autowire(service: SessionCart::class)] CartInterface $cartStrategy,
        CartHandler $cartHandler
    ): Response {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable.');
        }

        $quantity = (int) $request->request->get('quantity', 1);
        if ($quantity < 1) {
            $quantity = 1;
        }

        // On récupère le panier actuel via la stratégie
        $cart = $cartStrategy->getCart('default_cart');
        
        // On crée l'item
        $item = new CartItem($product->getId(), $product, $product->getPrice(), $quantity);
        
        // On l'ajoute au panier via la stratégie
        $cart = $cartStrategy->add($item, $cart);

        // On passe par le CartHandler (comme demandé dans le diagramme de classe)
        $cart = $cartHandler->handle($cart, $cartStrategy);

        $this->addFlash('success', 'Produit ajouté au panier avec succès.');

        return $this->redirectToRoute('app_cart');
    }
}
