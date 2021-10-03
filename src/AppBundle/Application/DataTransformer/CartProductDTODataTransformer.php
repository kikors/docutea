<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Application\Service\Dto\CartProductDTO;
use AppBundle\Domain\Model\CartProduct;

class CartProductDTODataTransformer implements CartProductDTODataTransformerInterface
{
    /** @var CartProduct */
    private $cartProduct;

    /**
     * @param CartProduct $cartProduct
     */
    public function write($cartProduct): void
    {
        $this->cartProduct = $cartProduct;
    }

    /**
     * @return CartProductDTO
     */
    public function read(): CartProductDTO
    {
        $cartProductDTO = new CartProductDTO($this->cartProduct->product()->id(), $this->cartProduct->quantity());
        $cartProductDTO->setTotal($this->cartProduct->total());
        $cartProductDTO->setTaxes($this->cartProduct->taxes());
        $cartProductDTO->setTotalPrice($this->cartProduct->price());
        $cartProductDTO->setPrice($this->cartProduct->price());
        $cartProductDTO->setQuantity($this->cartProduct->quantity());

        $cartProductDTO->setCod($this->cartProduct->product()->getCod());
        $cartProductDTO->setNombre($this->cartProduct->product()->getNombre());
        $cartProductDTO->setDescription($this->cartProduct->product()->getDescription() ?: '');
        $cartProductDTO->setPrice($this->cartProduct->product()->getPrice());
        $cartProductDTO->setTaxes($this->cartProduct->product()->getTaxes());
        $cartProductDTO->setImagePerspective($this->cartProduct->product()->getImagePerspective() ?: '');
        $cartProductDTO->setImageFront($this->cartProduct->product()->getImageFront() ?: '');
        $cartProductDTO->setImageLateral($this->cartProduct->product()->getImageLateral() ?: '');
        $cartProductDTO->setAirPrint($this->cartProduct->product()->isAirPrint());
        $cartProductDTO->setWifi($this->cartProduct->product()->isWifi());
        $cartProductDTO->setCloud($this->cartProduct->product()->isCloud());
        $cartProductDTO->setNfc($this->cartProduct->product()->isNfc());
        $cartProductDTO->setSheet($this->cartProduct->product()->getSheet());

        return $cartProductDTO;
    }
}