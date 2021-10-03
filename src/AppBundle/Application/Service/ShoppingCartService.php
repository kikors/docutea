<?php


namespace AppBundle\Application\Service;


use AppBundle\Domain\Model\ShoppingCart;

interface ShoppingCartService
{
    public function updateShoppingCart(ShoppingCart $shoppingCart);

    public function getShoppingCart();
}