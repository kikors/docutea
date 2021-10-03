<?php


namespace AppBundle\Application\Service;


use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;

class GetShoppingCartProductsQtty implements ApplicationServiceInterface
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;

    /**
     * GetShoppingCartProductsQtty constructor.
     * @param ShoppingCartRepositoryInterface $repository
     */
    public function __construct(ShoppingCartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param null $orderDto
     * @return mixed
     */
    public function execute($orderDto = null): void
    {
        $cart = $this->repository->getCart();

        return $cart->productQtty();
    }

}