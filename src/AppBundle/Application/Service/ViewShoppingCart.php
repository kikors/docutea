<?php


namespace AppBundle\Application\Service;


use AppBundle\Application\DataTransformer\ShoppingCartDTODataTransformerInterface;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;

class ViewShoppingCart implements ApplicationServiceTransformInterface
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;
    /**
     * @var ShoppingCartDTODataTransformerInterface
     */
    private $dataTransformer;

    /**
     * ViewShoppingCart constructor.
     * @param ShoppingCartRepositoryInterface $repository
     * @param ShoppingCartDTODataTransformerInterface $dataTransformer
     */
    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        ShoppingCartDTODataTransformerInterface $dataTransformer
    )
    {
        $this->repository = $repository;
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * @param null $orderDto
     */
    public function execute($orderDto = null): void
    {
        $cart = $this->repository->getCart();
        $this->dataTransformer->write($cart);
    }

    /**
     * @return ShoppingCartDTODataTransformerInterface
     */
    public function getTransform()
    {
        return $this->dataTransformer;
    }
}