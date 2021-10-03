<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="drum")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\DrumRepository")
 */
class Drum implements PermittedActionsInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="code", type="string", nullable=true)
     */
    protected $code;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    protected $description;

    /**
     * @var TonerColor
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TonerColor")
     */
    protected $color;

    /**
     * @var TonerCapacity
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TonerCapacity")
     */
    protected $capacity;

    /**
     * @var float
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    protected $price;

    /**
     * @var integer
     * @ORM\Column(name="page_volume", type="integer", nullable=false)
     */
    protected $pageVolume;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $enabled = false;

    /**
     * @var string
     * @ORM\Column(name="aditional_info", type="text", nullable=true)
     */
    protected $aditionalInfo;

    /**
     * @var integer
     * @ORM\Column(name="recom_volume", type="integer", nullable=true)
     */
    protected $recomendedVolume;

    /**
     * Maquinas que usan el toner.
     *
     * @var Machine[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Machine", mappedBy="drums")
     **/
    protected $machines;

    /**
     * Toner constructor.
     */
    public function __construct()
    {
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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

    /**
     * @return TonerColor
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param TonerColor $color
     */
    public function setColor($color)
    {
        $this->color = $color;
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
    public function getPageVolume()
    {
        return $this->pageVolume;
    }

    /**
     * @param int $pageVolume
     */
    public function setPageVolume($pageVolume)
    {
        $this->pageVolume = $pageVolume;
    }

    /**
     * @return float
     */
    public function getCostByPage()
    {
        return $this->price/$this->pageVolume;
    }

    /**
     * @return TonerCapacity
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param TonerCapacity $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string
     */
    public function getAditionalInfo()
    {
        return $this->aditionalInfo;
    }

    /**
     * @param string $aditionalInfo
     */
    public function setAditionalInfo($aditionalInfo)
    {
        $this->aditionalInfo = $aditionalInfo;
    }

    /** {@inheritdoc} */
    public function __toString()
    {
        return $this->getDescription();
    }

    /**
     * @return int
     */
    public function getRecomendedVolume()
    {
        return $this->recomendedVolume;
    }

    /**
     * @param int $recomendedVolume
     */
    public function setRecomendedVolume($recomendedVolume)
    {
        $this->recomendedVolume = $recomendedVolume;
    }

    /**
     * Return todas las maquinas asociadas a un toner.
     *
     * @return Machine[]|ArrayCollection
     */
    public function getMachines()
    {
        return $this->machines;
    }

    /**
     * Setea todas las maquinas que usan un toner.
     *
     * @param Machine[] $machines
     */
    public function setMachines($machines)
    {
        $this->machines->clear();
        $this->machines = new ArrayCollection($machines);
    }

    /**
     * Adiciona una maquina.
     *
     * @param $machine Machine La maquina que se asociará
     */
    public function addMachine($machine)
    {
        if ($this->machines->contains($machine)) {
            return;
        }

        $this->machines->add($machine);
        $machine->addDrum($this);
    }

    /**
     * @param Machine $machine
     */
    public function removeMachine($machine)
    {
        if (!$this->machines->contains($machine)) {
            return;
        }

        $this->machines->removeElement($machine);
        $machine->removeDrum($this);
    }

    /**
     * Devuelve la cantidad de drums para un número de páginas
     * @param $pages
     * @return float|int
     */
    public function getCountByPages($pages)
    {
        return ($this->getRecomendedVolume() % $pages == 0) ?
            intdiv($this->getRecomendedVolume(), $pages) :
            intdiv($this->getRecomendedVolume(), $pages) + 1;
    }

    /**
     * @return boolean
     */
    function isDeletable() {
        return $this->getMachines()->isEmpty();
    }
}