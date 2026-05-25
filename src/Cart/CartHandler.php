<?php

namespace App\Cart;

class CartHandler
{
    public function handle(Cart $cart, CartInterface $strategy): Cart
    {
        // En fonction du besoin, le handler peut déléguer des tâches à la stratégie
        // ou simplement retourner le panier modifié.
        // Ici on satisfait le diagramme UML.
        return $cart;
    }
}
