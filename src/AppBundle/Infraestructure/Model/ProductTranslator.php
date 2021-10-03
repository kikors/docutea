<?php


namespace AppBundle\Infraestructure\Model;


use AppBundle\Domain\Model\Product;
use AppBundle\Domain\Model\ProductServiceInterface as ProductServiceInterface;
use AppBundle\Entity\ProductForPersistence;
use Exception;

class ProductTranslator implements ProductServiceInterface
{
    /**
     * @param ProductForPersistence $productForPersistence
     * @return Product
     * @throws Exception
     */
    public function translate(ProductForPersistence $productForPersistence): Product
    {
        $product = new Product(
            $productForPersistence->getId(),
            $productForPersistence->getCod(),
            $productForPersistence->getNombre(),
            $productForPersistence->getPrice(),
            $productForPersistence->getTaxes()
        );
        $product->setDescription($productForPersistence->getDescription());
        $product->setSubtitle($productForPersistence->getSubtitle());
        $product->setImageFront($productForPersistence->getImageFront());
        $product->setImageLateral($productForPersistence->getImageLateral());
        $product->setImagePerspective($productForPersistence->getImagePerspective());
        $product->setAirPrint($productForPersistence->isAirPrint());
        $product->setNfc($productForPersistence->isNfc());
        $product->setCloud($productForPersistence->isCloud());
        $product->setWifi($productForPersistence->isWifi());
        $product->setSheet($productForPersistence->getSheet());
        
        return $product;
    }
}