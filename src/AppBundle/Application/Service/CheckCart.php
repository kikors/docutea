<?php


namespace AppBundle\Application\Service;


use AppBundle\Application\DataTransformer\ShoppingCartDTODataTransformerInterface;
use AppBundle\Domain\Model\ProductRepositoryInterface;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;

class CheckCart implements ApplicationServiceTransformInterface
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
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * CheckCart constructor.
     * @param ShoppingCartRepositoryInterface $repository
     * @param ShoppingCartDTODataTransformerInterface $dataTransformer
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        ShoppingCartDTODataTransformerInterface $dataTransformer,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->repository = $repository;
        $this->dataTransformer = $dataTransformer;
        $this->productRepository = $productRepository;
    }

    /**
     * @param null $orderDto
     */
    public function execute($orderDto = null): void
    {
        $cart = $this->repository->getCart();
        if (0 === $cart->total()) {
            return;
        }
        foreach ($cart->getProducts() as $item) {
            $product = $this->productRepository->ofId($item->product()->id());
            $price = $item->product()->getPrice();
            if ($product->getPrice() !== $price) {
                $item->product()->setPrice($price);
            }
        }
        $this->repository->saveCart($cart);
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