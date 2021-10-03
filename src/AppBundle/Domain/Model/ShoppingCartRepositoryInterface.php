<?php


namespace AppBundle\Domain\Model;


interface ShoppingCartRepositoryInterface
{
    public function getCart(): ShoppingCart;

    public function saveCart(ShoppingCart $cart): void;
}