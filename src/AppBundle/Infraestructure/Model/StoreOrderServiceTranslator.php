<?php


namespace AppBundle\Infraestructure\Model;


use AppBundle\Domain\Model\StoreOrder;
use AppBundle\Domain\Model\StoreOrderServiceInterface;
use AppBundle\Entity\StoreOrderForPersistence;
use Exception;

class StoreOrderServiceTranslator implements StoreOrderServiceInterface
{
    /**
     * @param StoreOrderForPersistence $storesOrderForPersistence
     * @return StoreOrder
     * @throws Exception
     */
    public function translate(StoreOrderForPersistence $storesOrderForPersistence): StoreOrder
    {
        $storeOrder = new StoreOrder($storesOrderForPersistence->getId());
        $storeOrder->configureTransactionData(
            $storesOrderForPersistence->getIdTpv(),
            $storesOrderForPersistence->getAmount(),
            $storesOrderForPersistence->getDate(),
            $storesOrderForPersistence->getDescription()
        );
        $storeOrder->configureUserData(
            $storesOrderForPersistence->getName(),
            $storesOrderForPersistence->getCif(),
            $storesOrderForPersistence->getAddress(),
            $storesOrderForPersistence->getProvince(),
            $storesOrderForPersistence->getCp(),
            $storesOrderForPersistence->getPhone(),
            $storesOrderForPersistence->getEmail(),
            $storesOrderForPersistence->getTown()
        );
        $storeOrder->configureDeliveryAddress(
            $storesOrderForPersistence->getDeliveryAddress(),
            $storesOrderForPersistence->getDeliveryProvince(),
            $storesOrderForPersistence->getDeliveryCp(),
            $storesOrderForPersistence->getDeliveryTown()
        );
        $aceptarComunicacion = $storesOrderForPersistence->getAceptarComunicacion() ?: false;
        $storeOrder->setAceptarComunicacion($aceptarComunicacion);

        $storeOrder->setState($storesOrderForPersistence->getState());

        return $storeOrder;
    }

    /**
     * @param StoreOrder $storeOrder
     * @return StoreOrderForPersistence
     * @throws Exception
     */
    public function unTranslate(StoreOrder $storeOrder): StoreOrderForPersistence
    {
        $storesOrderForPersistence = new StoreOrderForPersistence();
        $storesOrderForPersistence->setId($storeOrder->getId());
        $storesOrderForPersistence->setIdTpv($storeOrder->getIdTpv());
        $storesOrderForPersistence->setAmount($storeOrder->getAmount());
        $storesOrderForPersistence->setDate($storeOrder->getDate());
        $storesOrderForPersistence->setDescription($storeOrder->getDescrition());
        $storesOrderForPersistence->setName($storeOrder->getName());
        $storesOrderForPersistence->setCif($storeOrder->getCif());
        $storesOrderForPersistence->setAddress($storeOrder->getAddress());
        $storesOrderForPersistence->setProvince($storeOrder->getProvince());
        $storesOrderForPersistence->setCp($storeOrder->getCp());
        $storesOrderForPersistence->setPhone($storeOrder->getPhone());
        $storesOrderForPersistence->setEmail($storeOrder->getEmail());
        $storesOrderForPersistence->setTown($storeOrder->getTown());
        $storesOrderForPersistence->setState($storeOrder->getState());
        $storesOrderForPersistence->setTransactId($storeOrder->getTransactId());
        $storesOrderForPersistence->setDeliveryAddress($storeOrder->getDeliveryAddress());
        $storesOrderForPersistence->setDeliveryProvince($storeOrder->getDeliveryProvince());
        $storesOrderForPersistence->setDeliveryCp($storeOrder->getDeliveryCp());
        $storesOrderForPersistence->setDeliveryTown($storeOrder->getDeliveryTown());

        return $storesOrderForPersistence;
    }
}