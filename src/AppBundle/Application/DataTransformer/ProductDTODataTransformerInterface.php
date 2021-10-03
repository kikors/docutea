<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Domain\Model\Product;

interface ProductDTODataTransformerInterface
{
    public function write(Product $product): void;

    public function read();
}