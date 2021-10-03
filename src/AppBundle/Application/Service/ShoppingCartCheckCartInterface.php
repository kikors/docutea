<?php


namespace AppBundle\Application\Service;


use AppBundle\Domain\Model\ShoppingCart;

interface ShoppingCartCheckCartInterface
{
    public function check(ShoppingCart $cart): bool;
}