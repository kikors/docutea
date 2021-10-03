<?php


namespace AppBundle\Application\Service\Dto;

class ShoppingCartOperationsDTO
{
    /**
     * @var int
     */
    private $idProduct;

    /**
     * @var int
     */
    private $quantity;

    /**
     * ShoppingCartOperationsDTO constructor.
     * @param int $idProduct
     * @param int $quantity
     */
    public function __construct(int $idProduct, int $quantity)
    {
        $this->idProduct = $idProduct;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getIdProduct(): int
    {
        return $this->idProduct;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}