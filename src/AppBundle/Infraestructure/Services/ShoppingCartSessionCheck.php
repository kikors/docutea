<?php


namespace AppBundle\Infraestructure\Services;


use AppBundle\Application\Service\ShoppingCartCheckCartInterface;
use AppBundle\Domain\Model\ShoppingCart;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;

class ShoppingCartSessionCheck implements ShoppingCartCheckCartInterface
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;

    /**
     * ShoppingCartSessionCheck constructor.
     * @param ShoppingCartRepositoryInterface $repository
     */
    public function __construct(ShoppingCartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ShoppingCart $cart
     * @return bool
     */
    public function check(ShoppingCart $cart): bool
    {
        $shoppingCart = $this->repository->getCart();
        return true;
    }
}