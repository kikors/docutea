<?php


namespace AppBundle\Application\Service;


use AppBundle\Application\DataTransformer\JsonDataTransformerInterface;
use AppBundle\Application\Service\Dto\CartProductBaseDTO;
use AppBundle\Domain\Model\ProductRepositoryInterface;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;

/**
 * Class AddProductToCart
 * @package AppBundle\Application\Service
 */
class AddProductToCart implements ApplicationServiceTransformInterface
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var JsonDataTransformerInterface
     */
    private $dataTransformer;

    /**
     * AddProductToCart constructor.
     * @param ShoppingCartRepositoryInterface $cartRepository
     * @param ProductRepositoryInterface $productRepository
     * @param JsonDataTransformerInterface $dataTransformer
     */
    public function __construct(
        ShoppingCartRepositoryInterface $cartRepository,
        ProductRepositoryInterface $productRepository,
        JsonDataTransformerInterface $dataTransformer
    )
    {
        $this->repository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * @param null|CartProductBaseDTO $orderDto
     * @throws Exception\CantBuildCartProductException
     */
    public function execute($orderDto = null): void
    {
        $cart = $this->repository->getCart();
        $product = $this->productRepository->ofId($orderDto->id());
        $cart->addProduct($product, $orderDto->qtty());
        $this->repository->saveCart($cart);
        $this->dataTransformer->write($cart);
    }

    public function getTransform()
    {
        return $this->dataTransformer;
    }
}