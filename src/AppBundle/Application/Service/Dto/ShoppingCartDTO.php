<?php


namespace AppBundle\Application\Service\Dto;


class ShoppingCartDTO
{
    /** @var array|CartProductDTO[] */
    private $cartProductsDTOs;

    /** @var int */
    private $totalQuantity;

    /** @var float */
    private $totalPrice;

    /** @var float */
    private $price;

    /**
     * @return CartProductDTO[]|array
     */
    public function getCartProductsDTOs(): array
    {
        return $this->cartProductsDTOs;
    }

    /**
     * @param CartProductDTO[]|array $cartProductsDTOs
     */
    public function setCartProductsDTOs($cartProductsDTOs): void
    {
        $this->cartProductsDTOs = $cartProductsDTOs;
    }

    /**
     * @return int
     */
    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }

    /**
     * @param int $totalQuantity
     */
    public function setTotalQuantity(int $totalQuantity): void
    {
        $this->totalQuantity = $totalQuantity;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}