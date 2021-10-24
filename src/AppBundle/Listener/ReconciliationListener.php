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
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManager;
use Exception;
use Monolog\Logger;

/**
 * Class ReconciliationListener
 *
 * @package AppBundle\Listener
 */
class ReconciliationListener
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
     * @var InvoiceManager
     */
    private $invoiceManager;

    /**
     * ReconciliationListener constructor.
     *
     * @param Logger $logger
     * @param EntityManager $em
     * @param InvoiceManager $invoiceManager
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
     * @throws ConnectionException
     * @throws Exception
     */
    public function onReconciliated(ConciliatedEvent $event)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $contract = $event->getSalesOrder();
            $this->logger->log('info', 'Reconciliando contrato ' . $event->getContractNumber());
            $reconciliation = $this->invoiceManager->createConciliation($contract);
            if (!$reconciliation) {
                throw new Exception('No se pudo reconciliar el contrato');
            }

            $invoice = $this->invoiceManager->createInvoice($contract);
            if ($invoice) {
                $contract->addInvoice($invoice);
            }

            $contract->addInvoice($reconciliation);
            $contract->setState(SalesOrderStates::CLOSE);

            $this->em->persist($contract);
            $this->em->flush();

            $this->em->getConnection()->commit();
            $this->logger->log('info', 'Terminada reconciliacion de contrato ' . $event->getContractNumber());
        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            $this->logger->log('info', 'No se pudo terminar la reconciliacion de contrato ' . $event->getContractNumber());
            throw $e;
        }
    }
}