<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 21/08/2017
 * Time: 15:59
 */

namespace AppBundle\Listener;

use AppBundle\Entity\Manager\SalesOrderManager;
use AppBundle\Entity\SalesOrder;
use AppBundle\Event\NewSalesOrderEvent;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailNotifier;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailSalesOrderNotificationContent;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailSalesOrderNotificationType;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\NotifierActions;
use AppBundle\Infraestructure\Services\Notification\LoggerNotification\LoggerNotificationContent;
use AppBundle\Infraestructure\Services\Notification\LoggerNotification\LoggerNotificationType;
use AppBundle\Infraestructure\Services\Notification\LoggerNotification\LoggerNotifier;
use AppBundle\Services\CreateSalesOrderDoc;
use Doctrine\ORM\EntityManager;
use Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Throwable;

/**
 * Class CreateOfertListener
 *
 * @package AppBundle\Listener
 */
class CreateOfertListener {

    private $loggerNotifier;

    private $salesOrdeRepository;

    private $manager;

    private $dispatcher;

    private $userRepository;

    private $adminNotificationMail;

    private $createSalesOrderDoc;

    private $emailNotifier;

    private $pdfFilePath;

    /**
     * CreateOfertListener constructor.
     *
     * @param EntityManager $em
     * @param SalesOrderManager $manager
     * @param EventDispatcher $dispatcher
     *
     * @param $adminNotificationMail
     *
     * @param CreateSalesOrderDoc $createSalesOrderDoc
     *
     * @param EmailNotifier $notifier
     *
     * @param LoggerNotifier $loggerNotifier
     *
     * @param $pdfFilePath
     *
     * @internal param \Monolog\Logger $loguer
     */
    public function __construct(EntityManager $em,
                                SalesOrderManager $manager,
                                EventDispatcherInterface $dispatcher,
                                $adminNotificationMail,
                                CreateSalesOrderDoc $createSalesOrderDoc,
                                EmailNotifier $notifier,
                                LoggerNotifier $loggerNotifier,
                                $pdfFilePath
    ) {
        $this->salesOrdeRepository = $em->getRepository('AppBundle:SalesOrder');
        $this->userRepository = $em->getRepository('AppBundle:User');
        $this->manager = $manager;
        $this->loggerNotifier = $loggerNotifier;
        $this->dispatcher = $dispatcher;
        $this->adminNotificationMail = $adminNotificationMail;
        $this->createSalesOrderDoc = $createSalesOrderDoc;
        $this->emailNotifier = $notifier;
        $this->pdfFilePath = $pdfFilePath;

    }

    /**
     * Este método será el encargado de crear una oferta.
     *
     * @param NewSalesOrderEvent $event
     *
     * @throws Exception
     * @throws Throwable
     */
    public function onCreateOfert(NewSalesOrderEvent $event) {

        $user = $event->getUser();
        $salesOrder = $this->manager->createNew($event);
        $user->addSalesOrder($salesOrder);
        $this->userRepository->save($user);

        $this->loggerNotifier->notify(
            new LoggerNotificationContent('info', 'Contrato ' . $salesOrder->getContractNumber() . ' ha sido guardado'),
            new LoggerNotificationType('logger')
        );

        $this->createSalesOrderDoc->create($salesOrder);
        $this->emailNotifier->notify(
            new EmailSalesOrderNotificationContent($salesOrder, $salesOrder->getCostumer()
                ->getEmail(), $this->atachList($salesOrder)),
            new EmailSalesOrderNotificationType(NotifierActions::NEW_SALES_ORDER_CREATE_USER_SUBJECT)
        );

        $this->loggerNotifier->notify(
            new LoggerNotificationContent('info', 'Contrato ' . $salesOrder->getContractNumber() . ' ha sido notificado al usuario'),
            new LoggerNotificationType('logger')
        );
        $this->emailNotifier->notify(
            new EmailSalesOrderNotificationContent($salesOrder, $this->adminNotificationMail, $this->atachList($salesOrder)),
            new EmailSalesOrderNotificationType(NotifierActions::NEW_SALES_ORDER_CREATE_USER_SUBJECT)
        );

        $this->loggerNotifier->notify(
            new LoggerNotificationContent('info', 'Contrato ' . $salesOrder->getContractNumber() . ' ha sido notificado al administrador'),
            new LoggerNotificationType('logger')
        );
    }

    private function atachList(SalesOrder $salesOrder) {

        $filename = $salesOrder->getContractNumber() . '_info.pdf';
        $result[] = $this->pdfFilePath.$filename;

        return $result;
    }
}