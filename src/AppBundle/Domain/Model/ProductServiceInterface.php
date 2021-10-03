<?php


namespace AppBundle\Domain\Model;


use AppBundle\Entity\ProductForPersistence;

interface ProductServiceInterface
{
    public function translate(ProductForPersistence $productForPersistence): Product;
}