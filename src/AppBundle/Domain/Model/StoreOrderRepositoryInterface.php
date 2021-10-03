<?php


namespace AppBundle\Domain\Model;


interface StoreOrderRepositoryInterface
{
    public function ofId(string $id): ?StoreOrder;

    public function ofTransactId(string $id): ?StoreOrder;

    public function save(StoreOrder $order): void;
}