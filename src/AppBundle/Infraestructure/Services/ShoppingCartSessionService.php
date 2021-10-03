<?php


namespace AppBundle\Infraestructure\Services;


use AppBundle\Application\Service\ShoppingCartService;
use AppBundle\Domain\Model\ShoppingCart;
use Symfony\Component\HttpFoundation\Session\Session;

class ShoppingCartSessionService implements ShoppingCartService
{
    const CartSessionName = 'docutea-cart';
    /** @var Session */
    private $sessionService;

    /**
     * ShoppingCartSessionService constructor.
     * @param Session $sessionService
     */
    public function __construct(Session $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * @param ShoppingCart $shoppingCart
     */
    public function updateShoppingCart(ShoppingCart $shoppingCart)
    {
        $this->sessionService->set(self::CartSessionName, $shoppingCart);
    }

    /**
     * @return ShoppingCart|null
     */
    public function getShoppingCart()
    {
        return $this->sessionService->get(self::CartSessionName);
    }
}