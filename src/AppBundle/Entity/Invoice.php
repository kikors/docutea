<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\InvoiceRepository")
 */
class Invoice {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\SalesOrder
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SalesOrder", inversedBy="invoices")
     */
    private $salesOrder;

    /**
     * @var Machine
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Machine")
     */
    private $machine;

    /**
     * @var integer
     * @ORM\Column(name="invoice_year", type="integer", nullable=false)
     */
    private $invoiceYear;

    /**
     * @var string
     * @ORM\Column(name="invoice_code", type="string", nullable=false)
     */
    private $invoiceCode;


    /**
     * @var \DateTime
     * @ORM\Column(name="create_at", type="date", nullable=false)
     */
    private $createAt;

    /**
     * @var float
     * @ORM\Column(name="amount", type="float", nullable=false)
     */
    private $amount;

    /**
     * @var \DateTime
     * @ORM\Column(name="start_date", type="date", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="end_date", type="date", nullable=false)
     */
    private $endDate;

    /**
     * @var string
     * @ORM\Column(name="invoice_type", type="string", nullable=false)
     */
    private $invoiceType;

    /**
     * Invoice constructor.
     *
     * @param SalesOrder $salesOrder
     * @param $type
     * @param $code
     * @param int $amount
     */
    public function __construct($salesOrder = null, $type = null, $code = null, $amount = null) {

        $this->setSalesOrder($salesOrder);
        $this->setCreateAt(new \DateTime());
        $this->setInvoiceYear($this->generateYear());
        $this->setAmount($amount);
        $this->setStartDate($this->startDate());
        $this->setInvoiceCode($code);
        $this->setInvoiceType($type);
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return \AppBundle\Entity\SalesOrder
     */
    public function getSalesOrder() {
        return $this->salesOrder;
    }

    /**
     * @param \AppBundle\Entity\SalesOrder $salesOrder
     */
    public function setSalesOrder($salesOrder) {
        $this->salesOrder = $salesOrder;
        if (!$this->salesOrder) {
            $this->machine = NULL;

            return;
        }
        $this->setMachine($this->salesOrder->getMachine());
    }

    /**
     * @return \DateTime
     */
    public function getCreateAt() {
        return $this->createAt;
    }

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt($createAt) {
        $this->createAt = $createAt;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getInvoiceCode();
    }

    /**
     * @return float|int
     */
    public function getFixedPrice() {
        if (!$this->salesOrder) {

            return 0;
        }

        return $this->salesOrder->getFixedPrice();
    }

    /**
     * @return float|int
     */
    public function getVariablePrice() {
        if (!$this->salesOrder) {

            return 0;
        }

        return $this->salesOrder->getVariablePrice();
    }

    /**
     * @return float|int
     */
    public function getBasePrice() {

        return round($this->salesOrder->getMonthPrice(), 5);
    }

    /**
     * @return float|int
     */
    public function getTax() {

        return round($this->getBasePrice() * 0.21, 5);
    }

    /**
     * @return float|int
     */
    public function getTotal() {

        return round($this->getBasePrice() + $this->getTax(), 5);
    }

    /**
     * @return string
     */
    public function getMachineDescription() {
        if (!$this->salesOrder || !$this->salesOrder->getMachine()) {

            return '';
        }

        return $this->salesOrder->getMachine()->getDescription();
    }

    /**
     * @return string
     */
    public function getMachineSerial() {
        if (!$this->salesOrder) {

            return '';
        }

        return $this->salesOrder->getSerialNumber();
    }

    /**
     * @return string
     */
    public function getContractNumber() {
        if (!$this->salesOrder) {

            return '';
        }

        return $this->salesOrder->getContractNumber();
    }

    /**
     * @return Machine
     */
    public function getMachine() {
        return $this->machine;
    }

    /**
     * @param Machine $machine
     */
    public function setMachine($machine) {
        $this->machine = $machine;
    }

    /**
     * @return int
     */
    public function getInvoiceYear() {
        return $this->invoiceYear;
    }

    /**
     * @param int $invoiceYear
     */
    public function setInvoiceYear($invoiceYear) {
        $this->invoiceYear = $invoiceYear;
    }

    /**
     * @return string
     */
    public function getInvoiceCode() {

        return $this->invoiceCode;
    }

    /**
     * @param string $invoiceCode
     */
    public function setInvoiceCode($invoiceCode) {
        $this->invoiceCode = $invoiceCode;
    }

    /**
     * @return float
     */
    public function getAmount() {

        return $this->amount;
    }

    /**
     * @param $amount
     *
     */
    public function setAmount($amount) {

        $this->amount = $amount;
    }

    /**
     * @return string
     */
    function generateYear() {
        $now = new \DateTime();

        return $now->format('Y');
    }

    /**
     * @return \DateTime
     */
    private function startDate() {
        $now = new \DateTime();

        return new \DateTime('1-' . $now->format('m') . '-' . $now->format('Y'));
    }

    /**
     * @return \DateTime
     */
    public function getStartDate() {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate) {
        $this->startDate = $startDate;
        $this->setEndDate($this->endDate($startDate));
    }

    /**
     * @return \DateTime
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate) {
        $this->endDate = $endDate;
    }

    /**
     * @param \DateTime $startDate
     *
     * @return \DateTime
     */
    private function endDate(\DateTime $startDate){
        $month = intval($startDate->format('m')) + 1;
        $endDay = new \DateTime($startDate->format('d') . '-' . $month . '-' . $startDate->format('Y'));
        $endDay->modify('- 1 day');
        return $endDay;
    }

    /**
     * @return string
     */
    public function getInvoiceType() {
        return $this->invoiceType;
    }

    /**
     * @param $invoiceType
     */
    public function setInvoiceType($invoiceType) {
        $this->invoiceType = $invoiceType;
    }


}