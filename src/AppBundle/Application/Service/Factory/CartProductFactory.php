<?php


namespace AppBundle\Application\Service\Factory;


use AppBundle\Application\Service\Exception\CantBuildCartProductException;
use AppBundle\Domain\Model\CartProduct;
use AppBundle\Domain\Model\Product;

class CartProductFactory
{
    /**
     * @param Product $product
     * @param int $quantity
     * @return CartProduct
     * @throws CantBuildCartProductException
     */
    public static function createCartProduct(Product $product, int $quantity): CartProduct
    {
        if (!$product || $quantity <= 0) {
            throw new CantBuildCartProductException();
        }
        return new CartProduct($product, $quantity);
    }
}