<?php


namespace AppBundle\Domain\Model;


interface ProductRepositoryInterface
{
    /**
     * @return array|Product[]
     */
    public function all(): array;

    /**
     * @return array|Product[]
     */
    public function allEnabled(): array;

    /**
     * @param int $id
     * @return Product|null
     */
    public function ofId(int $id): ?Product;
}