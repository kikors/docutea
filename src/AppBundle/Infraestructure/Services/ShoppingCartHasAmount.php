<?php


namespace AppBundle\Infraestructure\Services;


use AppBundle\Application\Service\ViewShoppingCart;

class ShoppingCartHasAmount
{
    /**
     * @var ViewShoppingCart
     */
    private $viewShoppingCart;

    /**
     * ShoppingCartHasAmount constructor.
     * @param ViewShoppingCart $viewShoppingCart
     */
    public function __construct(ViewShoppingCart $viewShoppingCart)
    {
        $this->viewShoppingCart = $viewShoppingCart;
    }

    public function hasAmount(): bool
    {
        $this->viewShoppingCart->execute();
        $cart = $this->viewShoppingCart->getTransform()->read();

        return 0 < $cart->getTotalPrice();
    }
}