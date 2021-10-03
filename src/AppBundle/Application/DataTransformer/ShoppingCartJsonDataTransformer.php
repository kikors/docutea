<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Application\Service\Dto\ShoppingCartDTO;
use AppBundle\Domain\Model\ShoppingCart;

class ShoppingCartJsonDataTransformer implements JsonDataTransformerInterface
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
     * @param ArrayDataTransformerInterface $dataTransformer
     */
    public function __construct(ArrayDataTransformerInterface $dataTransformer)
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
     * @return string
     */
    public function read(): string
    {
        $totalPrice = $this->shoppingCart->total();
        $shoppingCartArray = [
            'price' => $this->shoppingCart->totalPrice(),
            'totalPrice' => $totalPrice,
            'totalQuantity' => $this->shoppingCart->productQtty()
        ];
        $cartProductJsonArray = [];
        if (0 === $totalPrice) {
            $shoppingCartArray['cartProducts'] = json_encode($cartProductJsonArray, true);

            return json_encode($shoppingCartArray);
        }
        foreach ($this->shoppingCart->getProducts() as $cartProduct) {
            $this->dataTransformer->write($cartProduct);
            $cartProductJsonArray[] = json_encode($this->dataTransformer->read(), true);
        }
        $shoppingCartArray['cartProducts'] = $cartProductJsonArray;
        $result = json_encode($shoppingCartArray, true);

        return $result;
    }
}