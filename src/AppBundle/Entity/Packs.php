<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="packs")
 */
class Packs
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var costumer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Maker")
     */
    protected $maker;

    /**
     * @var float
     * @ORM\Column(name="price", type="float")
     */
    protected $price;

    /**
     * @var int
     * @ORM\Column(name="years", type="integer", nullable=false)
     */
    protected $years;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return costumer
     */
    public function getMaker()
    {
        return $this->maker;
    }

    /**
     * @param costumer $maker
     */
    public function setMaker($maker)
    {
        $this->maker = $maker;
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
     * @return int
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @param int $years
     */
    public function setYears($years)
    {
        $this->years = $years;
    }

    /** {@inheritdoc} */
    public function __toString()
    {
        if (!$this->getMaker()) {

            return $this->getYears();
        }

        return $this->getMaker()->getNombre().' - '.$this->getYears();
    }
}