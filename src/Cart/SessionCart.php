<?php

namespace App\Cart;

use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public function add(CartItem $item, Cart $cart): Cart
    {
        $cart->addItem($item);
        $this->saveCart($cart);
        
        return $cart;
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        $cart->removeItem($item);
        $this->saveCart($cart);
        
        return $cart;
    }

    public function getCart(string $identifier): Cart
    {
        $session = $this->requestStack->getSession();
        
        if ($session->has($identifier)) {
            return $session->get($identifier);
        }

        $cart = new Cart($identifier, new \DateTimeImmutable());
        $this->saveCart($cart);
        
        return $cart;
    }

    public function clearCart(string $identifier): void
    {
        $this->requestStack->getSession()->remove($identifier);
    }

    private function saveCart(Cart $cart): void
    {
        $this->requestStack->getSession()->set($cart->getId(), $cart);
    }
}
