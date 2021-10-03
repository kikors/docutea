<?php


namespace AppBundle\Domain\Model;


use AppBundle\Entity\StoreOrderForPersistence;

interface StoreOrderServiceInterface
{
    public function translate(StoreOrderForPersistence $storesOrderForPersistence): StoreOrder;

    public function unTranslate(StoreOrder $storesOrderForPersistence): StoreOrderForPersistence;
}