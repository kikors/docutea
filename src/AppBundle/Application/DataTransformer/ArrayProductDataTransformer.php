<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Application\Service\Dto\ProductDTO;
use AppBundle\Domain\Model\CartProduct;
use Exception;

class ArrayProductDataTransformer implements ArrayDataTransformerInterface
{
    /**
     * @var array|CartProduct
     */
    private $cartProduct;

    public function write($product): void
    {
        $this->cartProduct = $product;
    }

    /**
     * @return array|ProductDTO[]
     * @throws Exception
     */
    public function read(): array
    {
        $arrayProductDto = [
            'id' => $this->cartProduct->product()->id(),
            'quantity' => $this->cartProduct->quantity(),
            'totalPrice' => $this->cartProduct->price(),
            'taxes' => $this->cartProduct->taxes(),
            'total' => $this->cartProduct->total(),
            'cod' => $this->cartProduct->product()->getCod(),
            'nombre' => $this->cartProduct->product()->getNombre(),
            'description' => $this->cartProduct->product()->getDescription() ?: '',
            'price' => $this->cartProduct->price(),
            'imagePerspective' => $this->cartProduct->product()->getImagePerspective() ?: '',
            'imageFront' => $this->cartProduct->product()->getImageFront() ?: '',
            'imageLateras' => $this->cartProduct->product()->getImageLateral() ?: '',
            'sheet' => $this->cartProduct->product()->getSheet() ?: '',
            'airPrint' => $this->cartProduct->product()->isAirPrint(),
            'wifi' => $this->cartProduct->product()->isWifi(),
            'cloud' => $this->cartProduct->product()->isCloud(),
            'nfc' => $this->cartProduct->product()->isNfc(),
        ];

        return $arrayProductDto;
    }
}