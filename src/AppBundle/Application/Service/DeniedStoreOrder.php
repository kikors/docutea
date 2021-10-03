<?php


namespace AppBundle\Application\Service;

use AppBundle\Application\DataTransformer\ShoppingCartDTODataTransformerInterface;
use AppBundle\Application\Service\Notification\Notifier;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;
use AppBundle\Domain\Model\StoreOrderRepositoryInterface;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailSalesOrderNotificationType;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailStoreOrderNotification;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\NotifierActions;
use DateTime;
use Exception;

class DeniedStoreOrder implements ApplicationServiceInterface
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $cartRepository;
    /**
     * @var StoreOrderRepositoryInterface
     */
    private $storeOrderRepository;
    /**
     * @var Notifier
     */
    private $notifier;
    /**
     * @var ShoppingCartDTODataTransformerInterface
     */
    private $transformer;

    /**
     * SuccessStoreOrder constructor.
     * @param ShoppingCartRepositoryInterface $cartRepository
     * @param StoreOrderRepositoryInterface $storeOrderRepository
     * @param Notifier $notifier
     * @param ShoppingCartDTODataTransformerInterface $transformer
     */
    public function __construct(
        ShoppingCartRepositoryInterface $cartRepository,
        StoreOrderRepositoryInterface $storeOrderRepository,
        Notifier $notifier,
        ShoppingCartDTODataTransformerInterface $transformer
    )
    {
        $this->cartRepository = $cartRepository;
        $this->storeOrderRepository = $storeOrderRepository;
        $this->notifier = $notifier;
        $this->transformer = $transformer;
    }

    /**
     * @param null $tpvResponse
     * @throws Exception
     */
    public function execute($tpvResponse = null): void
    {
        $response = json_decode(base64_decode($tpvResponse), true);
        $storeOrder = $this->storeOrderRepository->ofTransactId($response['Ds_Order']);
        if (!$storeOrder) {
            throw new Exception(sprintf('La orden con el código %s no existe, contacte con el proveedor', $response['Ds_Order']));
        }
        $storeOrder->setIdTpv($response['Ds_AuthorisationCode']);
        $storeOrder->setAmount($this->converFloat($response['Ds_Amount']));
        $storeOrder->setDate($this->convertTimeString($response['Ds_Date'], $response['Ds_Hour']));
        $storeOrder->denied();

        $this->storeOrderRepository->save($storeOrder);
        $cart = $this->cartRepository->getCart();
        $this->transformer->write($cart);

//        $this->notifier->notify(
//            new EmailStoreOrderNotification($this->transformer->read(), $storeOrder->getEmail()),
//            new EmailSalesOrderNotificationType(NotifierActions::NOTIFY_STORE_ORDER_FAILED)
//        );
    }

    /**
     * @param string $dateString
     * @param string $hourString
     * @return DateTime
     * @throws Exception
     */
    private function convertTimeString(string $dateString, string $hourString): DateTime
    {
        $dateTime = str_replace('/','-',urldecode($dateString).' '. urldecode($hourString));

        return new DateTime($dateTime);
    }

    /**
     * @param string $stringFloat
     * @return float
     */
    private function converFloat(string $stringFloat): float
    {
        $value = floatval($stringFloat)/100;

        return $value;
    }
}