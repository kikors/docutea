<?php

namespace AppBundle\Entity;

use AppBundle\StaticsClass\TonerColors;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sent_consumable")
 */
class SentConsumable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \AppBundle\Entity\SalesOrder
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SalesOrder", inversedBy="sentConsumables")
     */
    protected $salesOrder;

    /**
     * @var \AppBundle\Entity\Toner
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Toner")
     */
    protected $toner;

    /**
     * @var float
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    protected $price;

    /**
     * @var \DateTime
     * @ORM\Column(name="sent_at", type="date", nullable=false)
     */
    protected $sentAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \AppBundle\Entity\SalesOrder
     */
    public function getSalesOrder()
    {
        return $this->salesOrder;
    }

    /**
     * @param \AppBundle\Entity\SalesOrder $salesOrder
     */
    public function setSalesOrder($salesOrder)
    {
        $this->salesOrder = $salesOrder;
    }

    /**
     * @return \AppBundle\Entity\Toner
     */
    public function getToner()
    {
        return $this->toner;
    }

    /**
     * @param \AppBundle\Entity\Toner $toner
     */
    public function setToner($toner)
    {
        $this->toner = $toner;
        if ($toner->isBlack()) {
            $this->setPrice($this->salesOrder->getPriceTonerBlack());
            return;
        }
        $this->setPrice($this->salesOrder->getPriceTonerColor());

    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * @param \DateTime $sentAt
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
    }

    public function __toString()
    {
        if (!$this->salesOrder) {

            return '';
        }
        return $this->salesOrder->getContractNumber() . '--' . $this->toner->getDescription();
    }

    public function isBlack()
    {
        return $this->toner->getColor() === TonerColors::BLACK;
    }
}