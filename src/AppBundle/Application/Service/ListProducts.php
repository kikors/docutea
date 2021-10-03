<?php


namespace AppBundle\Application\Service;


use AppBundle\Application\DataTransformer\ArrayDataTransformerInterface;
use AppBundle\Application\DataTransformer\ArrayListProductDTODataTransformer;
use AppBundle\Application\DataTransformer\ProductDTODataTransformerInterface;
use AppBundle\Domain\Model\Product;
use AppBundle\Domain\Model\ProductRepositoryInterface;

class ListProducts implements ApplicationServiceTransformInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var ArrayDataTransformerInterface
     */
    private $dataTransformer;

    /**
     * ListProducts constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param ArrayDataTransformerInterface $dataTransformer
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ArrayDataTransformerInterface $dataTransformer
    )
    {
        $this->productRepository = $productRepository;
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * @param null $orderDto
     */
    public function execute($orderDto = null): void
    {
        $products = $this->productRepository->allEnabled();
        $this->dataTransformer->write($products);
    }

    public function getTransform()
    {
        return $this->dataTransformer;
    }
}