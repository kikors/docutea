<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 21/08/2017
 * Time: 15:59
 */

namespace AppBundle\Listener;

use AppBundle\Entity\Manager\InvoiceManager;
use AppBundle\Entity\SalesOrder;
use AppBundle\StaticsClass\SalesOrderStates;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManager;
use Exception;
use Monolog\Logger;

/**
 * Class TerminateListener
 *
 * @package AppBundle\Listener
 */
class ConsolidateListener
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
     * @throws ConnectionException
     * @throws Exception
     */
    public function onCheckIn()
    {
        $salesOrderAccepted = $this->em->getRepository('AppBundle:SalesOrder')->findBy([
            'state' => SalesOrderStates::ACCEPTED
        ]);
        foreach ($salesOrderAccepted as $salesOrder) {
            $this->singleCheckIn($salesOrder);
        }
    }

    /**
     * Este método será el encargado de crear una oferta.
     *
     * @param SalesOrder $salesOrder
     * @throws ConnectionException
     */
    public function singleCheckIn(SalesOrder $salesOrder)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->logger->log('info', 'Facturando contrato ' . $salesOrder->getContractNumber());
            $invoice = $this->invoiceManager->createInvoice($salesOrder);
            if (!$invoice) {
                throw new Exception('No se pudo facturar el contrato ' . $salesOrder->getContractNumber());
            }

            $salesOrder->addInvoice($invoice);

            $this->em->persist($salesOrder);
            $this->em->flush();

            $this->em->getConnection()->commit();
            $this->logger->log('info', 'Terminada facturación de contrato ' . $salesOrder->getContractNumber());
        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            $this->logger->log('info', 'No se pudo facturar el contrato ' . $salesOrder->getContractNumber());
        }
    }
}