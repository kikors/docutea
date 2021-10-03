<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 17/10/2017
 * Time: 23:28
 */

namespace AppBundle\Entity\Manager;

use AppBundle\Entity\Invoice;
use AppBundle\Entity\Toner;
use AppBundle\Services\DateTools;
use AppBundle\Services\InvoiceCodeGenerator;
use AppBundle\StaticsClass\InvoiceTypes;
use AppBundle\StaticsClass\SalesOrderStates;
use Doctrine\ORM\EntityManager;
use Ivory\CKEditorBundle\Exception\Exception;


/**
 * Class InvoiceManager
 *
 * @package AppBundle\Entity\Manager
 */
class InvoiceManager
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $invoiceRepository;

    /**
     * @var \AppBundle\Services\InvoiceCodeGenerator
     */
    private $invoiceCodegenerator;

    private $dateTools;

    /**
     * InvoiceManager constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param \AppBundle\Services\InvoiceCodeGenerator $invoiceCodegenerator
     * @param \AppBundle\Services\DateTools $dateTools
     */
    public function __construct(EntityManager $em, InvoiceCodeGenerator $invoiceCodegenerator, DateTools $dateTools)
    {
        $this->em = $em;
        $this->invoiceCodegenerator = $invoiceCodegenerator;
        $this->invoiceRepository = $em->getRepository('AppBundle:Invoice');
        $this->dateTools = $dateTools;
    }

    /**
     * @param \AppBundle\Entity\SalesOrder $salesOrder
     *
     * @return \AppBundle\Entity\Invoice
     * @throws \Exception
     */
    public function createInvoice($salesOrder)
    {
        if (!$salesOrder->isCheck()) {

            return new Invoice(
                $salesOrder,
                InvoiceTypes::CARGO,
                $this->invoiceCodegenerator->generate(InvoiceTypes::CARGO),
                $salesOrder->getMonthPrice()
            );
        }

        return null;
    }

    /**
     * @param \AppBundle\Entity\SalesOrder $salesOrder
     *
     * @return \AppBundle\Entity\Invoice
     * @throws \Exception
     */
    public function createConciliation($salesOrder)
    {
        $amount = $this->calculateAmount($salesOrder) - $salesOrder->getMonthPrice();
        $invoiceType = ($amount < 0) ? InvoiceTypes::ABONO : InvoiceTypes::CARGO;

        return new Invoice(
            $salesOrder,
            $invoiceType,
            $this->invoiceCodegenerator->generate($invoiceType),
            $amount
        );
    }

    /**
     * @param \AppBundle\Entity\SalesOrder $salesOrder
     *
     * @return float
     */
    private function calculateAmount($salesOrder)
    {
        $consumables = $salesOrder->getSentConsumables();
        $invoices = $salesOrder->getInvoices();
        $consumablesAmount = 0;
        $invoicesAmount = 0;
        /** @var Toner $consumable */
        if ($consumables->isEmpty() && $invoices->isEmpty()) {

            return 0;
        }

        foreach ($consumables as $consumable) {
            $consumablesAmount += ($consumable->isBlack()) ? $salesOrder->getPriceTonerBlack() : $salesOrder->getPriceTonerColor();
        }
        foreach ($invoices as $invoice) {
            $invoicesAmount += $invoice->getTotal();
        }

        return $consumablesAmount - $invoicesAmount;
    }

    /**
     * @param Invoice $invoice
     *
     * @return bool|Invoice
     */
    public function exits($invoice)
    {
        $invoice = $this->invoiceRepository->findOneBy(['startDate' => $invoice->getStartDate(), 'invoiceType' => $invoice->getInvoiceType()]);
        if (!$invoice) {

            return false;
        }

        return $invoice;
    }

    /**
     * @param \DateTime $startDate
     * @param $type
     *
     * @return bool|Invoice
     *
     */
    public function isFacturated(\DateTime $startDate, $type)
    {
        $invoiceList = $this->invoiceRepository->findBy(['startDate' => $startDate, 'invoiceType' => $type]);
        if (!$invoiceList) {

            return false;
        }

        return true;
    }
}