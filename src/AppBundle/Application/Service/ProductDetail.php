<?php


namespace AppBundle\Application\Service;


use AppBundle\Application\DataTransformer\ProductDTODataTransformerInterface;
use AppBundle\Domain\Model\ProductRepositoryInterface;
use Exception;

class ProductDetail implements ApplicationServiceTransformInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var ProductDTODataTransformerInterface
     */
    private $dataTransformer;

    /**
     * ListProducts constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param ProductDTODataTransformerInterface $dataTransformer
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductDTODataTransformerInterface $dataTransformer
    )
    {
        $this->productRepository = $productRepository;
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * @param null $orderDto
     * @throws Exception
     */
    public function execute($orderDto = null): void
    {
        $product = $this->productRepository->ofId($orderDto);
        if (!$product || !$product->isEnabled()) {
            throw new Exception('Producto incorrecto, no existe o está desabilitado');
        }
        $this->dataTransformer->write($product);
    }

    /**
     * @return ProductDTODataTransformerInterface
     */
    public function getTransform()
    {
        return $this->dataTransformer;
    }
}