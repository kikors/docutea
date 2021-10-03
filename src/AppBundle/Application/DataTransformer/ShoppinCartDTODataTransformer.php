<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Application\Service\Dto\ShoppingCartDTO;
use AppBundle\Domain\Model\ShoppingCart;

class ShoppinCartDTODataTransformer implements ShoppingCartDTODataTransformerInterface
{
    /**
     * @var ShoppingCart
     */
    private $shoppingCart;
    /**
     * @var CartProductDTODataTransformerInterface
     */
    private $dataTransformer;

    /**
     * ShoppinCartDTODTODataTransformer constructor.
     * @param CartProductDTODataTransformerInterface $dataTransformer
     */
    public function __construct(CartProductDTODataTransformerInterface $dataTransformer)
    {
        $this->dataTransformer = $dataTransformer;
    }

    /**
     * @param $shoppingCart
     */
    public function write($shoppingCart): void
    {
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * @return ShoppingCartDTO
     */
    public function read(): ShoppingCartDTO
    {
        $shoppingCartDTO = new ShoppingCartDTO();
        $total = $this->shoppingCart->total();
        $shoppingCartDTO->setTotalQuantity($this->shoppingCart->productQtty());
        $shoppingCartDTO->setPrice($this->shoppingCart->totalPrice());
        $shoppingCartDTO->setTotalPrice($total);
        $cartProductDTOArray = [];
        if (0 === $total) {
            $shoppingCartDTO->setCartProductsDTOs($cartProductDTOArray);

            return $shoppingCartDTO;
        }
        foreach ($this->shoppingCart->getProducts() as $cartProduct) {
            $this->dataTransformer->write($cartProduct);
            $cartProductDTOArray[] = $this->dataTransformer->read();
        }
        $shoppingCartDTO->setCartProductsDTOs($cartProductDTOArray);

        return $shoppingCartDTO;
    }
}