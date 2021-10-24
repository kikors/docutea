<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 21/08/2017
 * Time: 15:59
 */

namespace AppBundle\Listener;

use AppBundle\Entity\Manager\InvoiceManager;
use AppBundle\Event\ConciliatedEvent;
use AppBundle\StaticsClass\SalesOrderStates;
use Doctrine\ORM\EntityManager;
use Exception;
use Monolog\Logger;

/**
 * Class TerminateListener
 *
 * @package AppBundle\Listener
 */
class TerminateListener
{

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var \AppBundle\Entity\Manager\InvoiceManager
     */
    private $invoiceManager;

    /**
     * ReconciliationListener constructor.
     *
     * @param Logger $logger
     * @param \Doctrine\ORM\EntityManager $em
     * @param \AppBundle\Entity\Manager\InvoiceManager $invoiceManager
     */
    public function __construct(Logger $logger, EntityManager $em, InvoiceManager $invoiceManager)
    {
        $this->logger = $logger;
        $this->em = $em;
        $this->invoiceManager = $invoiceManager;
    }

    /**
     * Este método será el encargado de crear una oferta.
     *
     * @param ConciliatedEvent $event
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws Exception
     */
    public function onTerminated(ConciliatedEvent $event)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $contract = $event->getSalesOrder();
            $this->logger->log('info', 'Terminnado contrato ' . $event->getContractNumber());
            $reconciliation = $this->invoiceManager->createInvoice($contract);
            if (!$reconciliation) {
                throw new Exception('No se pudo reconciliar el contrato');
            }

            $contract->addInvoice($reconciliation);
            $contract->setState(SalesOrderStates::CLOSE);

            $this->em->persist($contract);
            $this->em->flush();

            $this->em->getConnection()->commit();
            $this->logger->log('info', 'Terminada finalización de contrato ' . $event->getContractNumber());
        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            $this->logger->log('info', 'No se pudo finalizar el contrato ' . $event->getContractNumber());
            throw $e;
        }
    }
}