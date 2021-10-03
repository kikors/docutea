<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ker_pack")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CarePackRepository")
 */
class CarePack implements PermittedActionsInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    protected $description;

    /**
     * @var Maker
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Maker")
     */
    protected $maker;

    /**
     * @var int
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    protected $duration;

    /**
     * @var float
     * @ORM\Column(name="price", type="float")
     */
    protected $price;

    /**
     * @var \AppBundle\Entity\Machine []
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Machine", mappedBy="carePack")
     */
    protected $machines;

    /**
     * Carepack constructor.
     */
    public function __construct() {
        $this->machines = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /** {@inheritdoc} */
    public function __toString()
    {
        return $this->getDescription();
    }

    /**
     * @return Maker
     */
    public function getMaker()
    {
        return $this->maker;
    }

    /**
     * @param Maker $maker
     */
    public function setMaker($maker)
    {
        $this->maker = $maker;
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
     * @param float $profit
     * @return float
     */
    public function getPriceByMonth($profit)
    {
        return ($this->getPrice() * $profit / $this->getDuration());
    }

    /**
     * @return \AppBundle\Entity\Machine[]
     */
    public function getMachines() {
        return $this->machines;
    }

    /**
     * @param \AppBundle\Entity\Machine[] $machines
     */
    public function setMachines(array $machines) {
        $this->machines = $machines;
    }

    /**
     * @return bool
     */
    public function isDeletable() {
        return $this->machines->isEmpty();
    }
}