<?php


namespace AppBundle\Application\Service;


use AppBundle\Application\DataTransformer\JsonDataTransformerInterface;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteProductToCart implements ApplicationServiceTransformInterface
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;
    /**
     * @var JsonDataTransformerInterface
     */
    private $dataTransformer;

    /**
     * DeleteProductToCart constructor.
     * @param ShoppingCartRepositoryInterface $repository
     * @param JsonDataTransformerInterface $dataTransformer
     */
    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        JsonDataTransformerInterface $dataTransformer
    )
    {
        $this->repository = $repository;
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * @param null $id
     */
    public function execute($id = null): void
    {
        $cart = $this->repository->getCart();
        $cart->deleteProduct($id);
        $this->repository->saveCart($cart);
        $this->dataTransformer->write($cart);
    }

    /**
     * @return JsonDataTransformerInterface
     */
    public function getTransform()
    {
        return $this->dataTransformer;
    }
}