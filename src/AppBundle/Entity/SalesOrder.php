<?php

namespace AppBundle\Entity;

use AppBundle\StaticsClass\SalesOrderStates;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="sales_order")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SalesOrderRepository")
 */
class SalesOrder implements PermittedActionsInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="salesOrder")
     */
    protected $costumer;

    /**
     * @var string
     * @ORM\Column(name="costumes_adress", type="string", nullable=false)
     */
    protected $costumerAdress;

    /**
     * @var Machine
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Machine", inversedBy="salesOrders")
     */
    protected $machine;

    /**
     * @var string
     * @ORM\Column(name="serial_number", type="string", nullable=true)
     */
    protected $serialNumber;

    /**
     * @var integer
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    protected $duration;

    /**
     * @var integer
     * @ORM\Column(name="pages", type="integer", nullable=false)
     */
    protected $pages;

    /**
     * @var float
     * @ORM\Column(name="color_percent", type="float", nullable=false)
     */
    protected $colorPercent;

    /**
     * @var string
     * @ORM\Column(name="state", type="string", nullable=false)
     */
    protected $state;

    /**
     * @var float
     * @ORM\Column(name="fixed_price", type="float", nullable=false)
     */
    protected $fixedPrice;

    /**
     * @var float
     * @ORM\Column(name="machine_fixed_price", type="float", nullable=false)
     */
    protected $machineFixedPrice;

    /**
     * @var float
     * @ORM\Column(name="month_price", type="float", nullable=false)
     */
    protected $monthPrice;

    /**
     * @var float
     * @ORM\Column(name="varible_price", type="float", nullable=false)
     */
    protected $variablePrice;

    /**
     * @var float
     * @ORM\Column(name="page_color_price", type="float", nullable=false)
     */
    protected $pageColorPrice;

    /**
     * @var float
     * @ORM\Column(name="page_black_price", type="float", nullable=false)
     */
    protected $pageBlackPrice;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="accepted_at", type="date", nullable=true)
     */
    protected $acceptedAt;

    /**
     * @var String
     * @ORM\Column(name="observations", type="text", nullable=true)
     */
    protected $observations;

    /**
     * @var String
     * @ORM\Column(name="contract_number", type="string", nullable=true)
     */
    protected $contractNumber;

    /**
     * @var SentConsumable[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SentConsumable", mappedBy="salesOrder")
     */
    protected $sentConsumables;

    /**
     * @var float
     * @ORM\Column(name="toner_year_amount_color", type="float", nullable=false)
     */
    protected $amountColor;

    /**
     * @var float
     * @ORM\Column(name="toner_year_amount_black", type="float", nullable=false)
     */
    protected $amountBlack;

    /**
     * @var integer
     * @ORM\Column(name="black_recomended_volume", type="integer",
     *     nullable=false)
     */
    protected $tonerBlackRecomendedVolume;

    /**
     * @var integer
     * @ORM\Column(name="color_recomended_volume", type="integer",
     *     nullable=false)
     */
    protected $tonerColorRecomendedVolume;

    /**
     * @var float
     * @ORM\Column(name="profit_duration", type="float", nullable=false)
     */
    protected $profitDuration;

    /**
     * @var float
     * @ORM\Column(name="profit_fixed", type="float", nullable=false)
     */
    protected $profitFixed;

    /**
     * @var float
     * @ORM\Column(name="profit_variable", type="float", nullable=false)
     */
    protected $profitVariable;

    /**
     * @var string
     * @ORM\Column(name="parent", type="string", nullable=true)
     */
    protected $parent;

    /**
     * @var Invoice []
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Invoice", mappedBy="salesOrder",cascade={"persist"}
     *     )
     */
    protected $invoices;

    /**
     * @ORM\Column(name="resume", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $resume;

    /**
     * This unmapped property stores the binary contents of the sheet file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="resume_file", fileNameProperty="resume")
     *
     * @var File
     */
    private $resumeFile;

    /**
     * @var string
     * @ORM\Column(name="aditional_main_info", type="text", nullable=true)
     */
    protected $aditionalMainInfo;

    /**
     * SalesOrder constructor.
     */
    public function __construct()
    {
        $this->invoices = new ArrayCollection();
        $this->sentConsumables = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getCostumer()
    {
        return $this->costumer;
    }

    /**
     * @param User $costumer
     */
    public function setCostumer($costumer)
    {
        $this->costumer = $costumer;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return float
     */
    public function getMachineFixedPrice()
    {
        return $this->machineFixedPrice;
    }

    /**
     * @param float $machineFixedPrice
     */
    public function setMachineFixedPrice($machineFixedPrice)
    {
        $this->machineFixedPrice = $machineFixedPrice;
    }

    /**
     * @return \DateTime
     */
    public function getAcceptedAt()
    {
        return $this->acceptedAt;
    }

    /**
     * @param \DateTime $acceptedAt
     */
    public function setAcceptedAt($acceptedAt)
    {
        $this->acceptedAt = $acceptedAt;
    }

    /** {@inheritdoc} */
    public function __toString()
    {
        if (!$this->getContractNumber()) {

            return '';
        }
        return $this->getContractNumber();
    }

    /**
     * @return float
     */
    public function getTonerBlackRecomendedVolume()
    {
        return $this->tonerBlackRecomendedVolume;
    }

    /**
     * @param $tonerBlackRecomendedVolume
     */
    public function setTonerBlackRecomendedVolume($tonerBlackRecomendedVolume)
    {
        $this->tonerBlackRecomendedVolume = $tonerBlackRecomendedVolume;
    }

    /**
     * @return float
     */
    public function getTonerColorRecomendedVolume()
    {
        return $this->tonerColorRecomendedVolume;
    }

    /**
     * @param $tonerColorRecomendedVolume
     */
    public function setTonerColorRecomendedVolume($tonerColorRecomendedVolume)
    {
        $this->tonerColorRecomendedVolume = $tonerColorRecomendedVolume;
    }

    /**
     * @return string
     */
    public function getCostumerAdress()
    {

        return $this->costumerAdress;
    }

    /**
     * @param string $costumerAdress
     */
    public function setCostumerAdress($costumerAdress)
    {

        $this->costumerAdress = $costumerAdress;
    }

    /**
     * @return float
     */
    public function getVariablePrice()
    {
        return round($this->variablePrice, 5);
    }

    /**
     * @param float $variablePrice
     */
    public function setVariablePrice($variablePrice)
    {
        $this->variablePrice = $variablePrice;
    }

    /**
     * @return float
     */
    public function getFixedPrice()
    {
        return round($this->fixedPrice, 5);
    }

    /**
     * @param float $fixedPrice
     */
    public function setFixedPrice($fixedPrice)
    {
        $this->fixedPrice = $fixedPrice;
    }

    /**
     * @return Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * @param Machine $machine
     *
     * @throws \Exception
     */
    public function setMachine($machine)
    {
        if (!$machine) {
            $this->machine = NULL;

            return;
        }

        if ($this->machine !== $machine) {
            $this->machine = $machine;
            $this->setPageColorPrice($machine->getColorPageCost());
            $this->setPageBlackPrice($machine->getBlackPageCost());
            $this->setMachineFixedPrice($machine->getMachineFixedPrice());
            $this->setTonerBlackRecomendedVolume($machine->getTonerBlack()
                ->getRecomendedVolume());
            $this->setTonerColorRecomendedVolume(0);
            if ($machine->isColor()) {
                $this->setTonerColorRecomendedVolume($machine->getTonerColor()
                    ->getRecomendedVolume());
            }
        }
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return float
     */
    public function getColorPercent()
    {
        return $this->colorPercent;
    }

    /**
     * @param float $colorPercent
     */
    public function setColorPercent($colorPercent)
    {
        $this->colorPercent = $colorPercent;
    }

    /**
     * @return float
     */
    public function getPageColorPrice()
    {
        return $this->pageColorPrice;
    }

    /**
     * @return float
     */
    public function getPageBlackPrice()
    {
        return $this->pageBlackPrice;
    }

    /**
     * @param float $pageColorPrice
     */
    public function setPageColorPrice($pageColorPrice)
    {
        $this->pageColorPrice = $pageColorPrice;
    }

    /**
     * @param float $pageBlackPrice
     */
    public function setPageBlackPrice($pageBlackPrice)
    {
        $this->pageBlackPrice = $pageBlackPrice;
    }

    /**
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * @param string $serialNumber
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @return string
     */
    public function getMachineName()
    {

        return $this->machine->getDescription();
    }

    /**
     * @return String
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @param \DateTime $observations
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;
    }

    /**
     * @return String
     */
    public function getContractNumber()
    {
        return $this->contractNumber;
    }

    /**
     * @param String $contractNumber
     */
    public function setContractNumber($contractNumber)
    {
        $this->contractNumber = $contractNumber;
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {

        return $this->costumer->getName();
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {

        return $this->costumer->getId();
    }

    /**
     * @return \AppBundle\Entity\SentConsumable[]|ArrayCollection
     */
    public function getSentConsumables()
    {
        return $this->sentConsumables;
    }

    /**
     * @param \AppBundle\Entity\SentConsumable[] |ArrayCollection $sentConsumables
     */
    public function setSentConsumables($sentConsumables)
    {
        $this->sentConsumables = $sentConsumables;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->machine->getCod();
    }

    /**
     * @return float
     */
    public function getAmountColor()
    {
        return $this->amountColor;
    }

    /**
     * @param float $amountColor
     */
    public function setAmountColor($amountColor)
    {
        $this->amountColor = $amountColor;
    }

    /**
     * @return float
     */
    public function getAmountBlack()
    {
        return $this->amountBlack;
    }

    /**
     * @param float $amountBlack
     */
    public function setAmountBlack($amountBlack)
    {
        $this->amountBlack = $amountBlack;
    }

    /**
     * @return string
     */
    public function getParent()
    {

        return $this->parent;
    }

    /**
     * @param SalesOrder $parent
     */
    public function setParent($parent)
    {
        if (!$parent) {
            $this->parent = NULL;

            return;
        }
        $this->parent = $parent->getContractNumber();
    }

    /**
     * @return float
     */
    public function getMonthPrice()
    {
        return $this->monthPrice;
    }

    /**
     * @param float $monthPrice
     */
    public function setMonthPrice($monthPrice)
    {
        $this->monthPrice = $monthPrice;
    }

    /**
     * @return float
     */
    public function getProfitDuration()
    {
        return $this->profitDuration;
    }

    /**
     * @param $profitDuration
     *
     * @internal param float $profitDutation
     */
    public function setProfitDuration($profitDuration)
    {
        $this->profitDuration = $profitDuration;
    }

    /**
     * @return float|int
     */
    public function getPriceTonerColor()
    {

        return ($this->getPageColorPrice() - $this->getPageBlackPrice()) / 3 * $this->getTonerColorRecomendedVolume();
    }

    /**
     * @return float|int
     */
    public function getPriceTonerBlack()
    {

        return $this->getPageBlackPrice() * $this->getTonerBlackRecomendedVolume();
    }

    /**
     * @return float
     */
    public function getProfitFixed()
    {
        return $this->profitFixed;
    }

    /**
     * @param float $profitFixed
     */
    public function setProfitFixed($profitFixed)
    {
        $this->profitFixed = $profitFixed;
    }

    /**
     * @return float
     */
    public function getProfitVariable()
    {
        return $this->profitVariable;
    }

    /**
     * @param float $profitVariable
     */
    public function setProfitVariable($profitVariable)
    {
        $this->profitVariable = $profitVariable;
        if (!$this->machine) {
            $this->setVariablePrice(0);

            return;
        }
    }

    /**
     * (Owning side).
     *
     * @param Invoice $invoice
     */
    public function addInvoice($invoice)
    {
        if ($this->invoices->contains($invoice)) {
            return;
        }

        $this->invoices->add($invoice);
    }

    /**
     * (Owning side).
     *
     * @param $invoice Invoice
     */
    public function removeInvoice($invoice)
    {
        if (!$this->invoices->contains($invoice)) {
            return;
        }

        $this->invoices->removeElement($invoice);
    }

    /**
     * @return Invoice[]|ArrayCollection
     */
    public function getInvoices()
    {
        return $this->invoices;
    }

    /**
     * @param Invoice[]|ArrayCollection $invoices
     */
    public function setInvoices($invoices)
    {
        foreach ($this->getInvoices() as $invoice) {
            $this->removeInvoice($invoice);
        }
        foreach ($invoices as $invoice) {
            $this->addInvoice($invoice);
        }
    }

    /**
     * @return boolean
     */
    public function isDeletable()
    {
        return ($this->invoices->isEmpty() && $this->sentConsumables->isEmpty()) && $this->getState() !== SalesOrderStates::CLOSE;
    }

    /**
     * @return boolean
     */
    public function isClosable()
    {
        return $this->getState() === SalesOrderStates::ACCEPTED;
    }

    /**
     * @return File
     */
    public function getResumeFile()
    {
        return $this->resumeFile;
    }

    /**
     * @param File|UploadedFile $resumeFile
     */
    public function setSheetFile(File $resumeFile = NULL)
    {
        $this->resumeFile = $resumeFile;
        if ($resumeFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $date = new DateTime();
            $this->aditionalMainInfo = $date->getTimestamp();
        }
    }

    /**
     * @return string
     */
    public function getAditionalMainInfo()
    {
        return $this->aditionalMainInfo;
    }

    /**
     * @param string $aditionalMainInfo
     */
    public function setAditionalMainInfo($aditionalMainInfo)
    {
        $this->aditionalMainInfo = $aditionalMainInfo;
    }

    /**
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param string $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isCheck()
    {
        if ($this->getState() !== SalesOrderStates::ACCEPTED) {

            return false;
        }
        foreach ($this->invoices as $invoice) {
            if ($invoice->getStartDate()->format('d-m-Y') === $this->firstDay()) {

                return true;
            }
        }

        return false;
    }

    /**
     * @return false|string
     */
    private function firstDay()
    {
        $month = date('m');
        $year = date('Y');
        return date('d-m-Y', mktime(0, 0, 0, $month, 1, $year));
    }
}