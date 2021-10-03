<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Application\Service\Dto\ProductDTO;
use AppBundle\Domain\Model\Product;
use Exception;

class ArrayListProductDTODataTransformer implements ArrayDataTransformerInterface
{
    /**
     * @var array|Product[]
     */
    private $products;
    /**
     * @var ProductDTODataTransformerInterface
     */
    private $dataTransformer;

    /**
     * ArrayProductDTODataTransformer constructor.
     * @param ProductDTODataTransformerInterface $dataTransformer
     */
    public function __construct(ProductDTODataTransformerInterface $dataTransformer)
    {
        $this->dataTransformer = $dataTransformer;
    }


    public function write($products): void
    {
        $this->products = $products;
    }

    /**
     * @return array|ProductDTO[]
     * @throws Exception
     */
    public function read(): array
    {
        $arrayProductDto = [];
        if (0 === count($this->products)) {

            return $arrayProductDto;
        }
        foreach ($this->products as $product) {
            $this->dataTransformer->write($product);
            $arrayProductDto[] = $this->dataTransformer->read();
        }

        return $arrayProductDto;
    }
}