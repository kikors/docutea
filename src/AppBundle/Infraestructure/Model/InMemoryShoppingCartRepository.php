<?php


namespace AppBundle\Infraestructure\Model;


use AppBundle\Domain\Model\ShoppingCart;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;
use Exception;
use Symfony\Component\HttpFoundation\Session\Session;

class InMemoryShoppingCartRepository implements ShoppingCartRepositoryInterface
{
    /**
     * @var Session
     */
    private $session;
    /**
     * @var string
     */
    private $key;

    /**
     * InMemoryShoppingCartRepository constructor.
     * @param Session $session
     * @param string $key
     */
    public function __construct(Session $session, string $key)
    {
        $this->session = $session;
        $this->key = $key;
    }

    /**
     * @return ShoppingCart
     * @throws Exception
     */
    public function getCart(): ShoppingCart
    {
        if (!$this->session->has($this->key)) {
            return new ShoppingCart();
        }

        return $this->session->get($this->key);
    }

    /**
     * @param ShoppingCart $cart
     */
    public function saveCart(ShoppingCart $cart): void
    {
        $this->session->set($this->key, $cart);
    }
}