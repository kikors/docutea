<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Application\Service\Dto\ProductDTO;
use AppBundle\Domain\Model\Product;
use Exception;

class ProductDTODataTransformer implements ProductDTODataTransformerInterface
{
    /**
     * @var Product
     */
    private $product;

    public function write(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return ProductDTO
     * @throws Exception
     */
    public function read()
    {
        $productDto = new ProductDTO();
        $productDto->setId($this->product->id());
        $productDto->setCod($this->product->getCod());
        $productDto->setNombre($this->product->getNombre());
        $productDto->setDescription($this->product->getDescription() ?: '');
        $productDto->setPrice($this->product->getPrice());
        $productDto->setTaxes($this->product->getTaxes());
        $productDto->setImagePerspective($this->product->getImagePerspective() ?: '');
        $productDto->setImageFront($this->product->getImageFront() ?: '');
        $productDto->setImageLateral($this->product->getImageLateral() ?: '');
        $productDto->setAirPrint($this->product->isAirPrint());
        $productDto->setWifi($this->product->isWifi());
        $productDto->setCloud($this->product->isCloud());
        $productDto->setNfc($this->product->isNfc());
        $productDto->setSheet($this->product->getSheet());

        return $productDto;
    }
}