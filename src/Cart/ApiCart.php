<?php

namespace App\Cart;

class ApiCart implements CartInterface
{
    public function add(CartItem $item, Cart $cart): Cart
    {
        dd('ApiCart strategy called: adding item');
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        dd('ApiCart strategy called: removing item');
    }

    public function getCart(string $identifier): Cart
    {
        dd('ApiCart strategy called: getting cart');
    }

    public function clearCart(string $identifier): void
    {
        dd('ApiCart strategy called: clearing cart');
    }
}
