<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ofert")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\OfertRepository")
 */
class Ofert
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Machine
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Machine")
     */
    protected $machine;

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
     * @var \DateTime
     * @ORM\Column(name="create_at", type="date", nullable=false)
     */
    protected $create_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * @param machine $machine
     */
    public function setMachine($machine)
    {
        $this->machine = $machine;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param float $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return float
     */
    public function getFixedPrice()
    {
        return 0;
    }

    /**
     * @return float
     */
    public function getVariblePrice()
    {
        return 0;
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

    /** {@inheritdoc} */
    public function __toString()
    {
        return $this->machine->getDescription();
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
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->create_at;
    }

    /**
     * @param \DateTime $create_at
     */
    public function setCreateAt($create_at)
    {
        $this->create_at = $create_at;
    }
}