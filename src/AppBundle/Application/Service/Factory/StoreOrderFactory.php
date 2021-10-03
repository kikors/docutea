<?php


namespace AppBundle\Application\Service\Factory;


use AppBundle\Application\Service\Dto\StoreOrderDTO;
use AppBundle\Domain\Model\StoreOrder;
use AppBundle\StaticsClass\StateStoreOrder;
use Exception;

class StoreOrderFactory
{
    /**
     * @param StoreOrderDTO $storeOrderDTO
     * @return StoreOrder
     * @throws Exception
     */
    public function createFromDto(StoreOrderDTO $storeOrderDTO): StoreOrder
    {
        $storeOrder = new StoreOrder();
        $storeOrder->configureTransactionData(
            $storeOrderDTO->getIdTpv(),
            $storeOrderDTO->getAmount(),
            $storeOrderDTO->getDate(),
            json_encode($storeOrderDTO->getDescrition())
        );
        $storeOrder->configureUserData(
            $storeOrderDTO->getName(),
            $storeOrderDTO->getCif(),
            $storeOrderDTO->getAddress(),
            $storeOrderDTO->getProvince(),
            $storeOrderDTO->getCp(),
            $storeOrderDTO->getPhone(),
            $storeOrderDTO->getEmail(),
            $storeOrderDTO->getTown()
        );
        $storeOrder->configureDeliveryAddress(
            $storeOrderDTO->getContactName(),
            $storeOrderDTO->getDeliveryAddress(),
            $storeOrderDTO->getDeliveryProvince(),
            $storeOrderDTO->getDeliveryCp(),
            $storeOrderDTO->getDeliveryTown()
        );
        $storeOrder->setState(StateStoreOrder::IN_PROGRESS);

        return $storeOrder;
    }
}