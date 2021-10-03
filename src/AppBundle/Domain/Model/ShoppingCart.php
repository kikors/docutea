<?php


namespace AppBundle\Domain\Model;

use AppBundle\Application\Service\Exception\CantBuildCartProductException;
use AppBundle\Application\Service\Factory\CartProductFactory;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Ramsey\Uuid\Uuid;

class ShoppingCart
{
    /** @var string */
    private $id;

    /** @var CartProduct[] */
    private $products;

    /**
     * ShoppingCart constructor.
     * @param null $id
     * @throws Exception
     */
    public function __construct($id = null)
    {
        $this->products = new ArrayCollection();
        if (!$id) {
            $id = Uuid::uuid1();
        }
        $this->id = $id;
    }

    /**
     * @param Product $product
     * @param int $qtty
     * @throws CantBuildCartProductException
     */
    public function addProduct(Product $product, int $qtty):void
    {
        /** @var CartProduct $cartProduct */
        if ($cartProduct = $this->products->get($product->id())) {
            $qtty += $cartProduct->quantity();
        }
        $this->updateProduct($product, $qtty);
    }

    /**
     * @param Product $product
     * @param int $qtty
     * @throws CantBuildCartProductException
     */
    public function updateProduct(Product $product, int $qtty):void
    {
        /** @var CartProduct $cartProduct */
        if ($cartProduct = $this->products->get($product->id())) {
            $this->products->remove($product->id());
        }
        $this->products->set($product->id(), CartProductFactory::createCartProduct($product, $qtty));
    }

    /**
     * @param $productId
     */
    public function deleteProduct($productId)
    {
        $this->products->remove($productId);
    }

    /**
     * @param $idProduct
     * @return CartProduct|null
     */
    public function ofProductId($idProduct)
    {
        return $this->products->get($idProduct);
    }

    /**
     * @return float|int
     */
    public function totalPrice()
    {
        $total = 0;
        if ($this->products->isEmpty()) {
            return $total;
        }
        foreach ($this->products as $product)
        {
            $total += $product->price();
        }

        return $total;
    }

    /**
     * @return float|int
     */
    public function totalTaxes()
    {
        $total = 0;
        if ($this->products->isEmpty()) {
            return $total;
        }
        foreach ($this->products as $product)
        {
            $total += $product->taxes();
        }

        return $total;
    }

    /**
     * @return float|int
     */
    public function total()
    {
        return $this->totalPrice() + $this->totalTaxes();
    }

    /**
     * @return int
     */
    public function productQtty(): int
    {
        $total = 0;
        if ($this->products->isEmpty()) {
            return $total;
        }
        foreach ($this->products as $product)
        {
            $total += $product->quantity();
        }

        return $total;
    }

    /**
     *
     */
    public function clearCart(): void
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return CartProduct[]
     */
    public function getProducts(): array
    {
        return $this->products->toArray();
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getMerchantData()
    {
        $result = [];
        if ($this->products->isEmpty()) {

            return $result;
        }

        foreach ($this->products as $product) {
            $result[] = [
                'nombre' => $product->product()->getNombre(),
                'descripcion' => $product->product()->getDescription(),
                'image' => $product->product()->getImageFront()
            ];
        }

        return $result;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}