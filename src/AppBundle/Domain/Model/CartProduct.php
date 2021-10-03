<?php


namespace AppBundle\Domain\Model;

class CartProduct
{
    /**
     * @var Product
     */
    private $product;
    /**
     * @var int
     */
    private $quantity;

    /**
     * CartProduct constructor.
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return Product
     */
    public function product(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function quantity(): int
    {
        return $this->quantity;
    }

    /**
     * Function price
     *
     * @return float|int
     */
    public function price()
    {
        return $this->product->getPrice() * $this->quantity;
    }

    /**
     * @return float
     */
    public function taxes(): float
    {
        return $this->price() * $this->product->getTaxes() /100;
    }

    /**
     * @return float
     */
    public function total(): float
    {
        return $this->price() + $this->taxes();
    }
}