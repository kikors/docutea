<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="part")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PartRepository")
 */
class Part implements PermittedActionsInterface
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
     * @var PartType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PartType")
     */
    protected $type;

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
     * @ORM\Column(name="enabled", type="boolean")
     */
    protected $enabled;

    /**
     * Maquinas que usan la pieza.
     *
     * @var Machine[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Machine", mappedBy="parts")
     **/
    protected $machines;

    /**
     * @var integer
     * @ORM\Column(name="recom_volume", type="integer", nullable=true)
     */
    protected $recomendedVolume;

    /**
     * @var string
     * @ORM\Column(name="aditional_info", type="text", nullable=true)
     */
    protected $aditionalInfo;

    /**
     * Part constructor.
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
     * @return PartType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param PartType $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
        return $this->getPrice()/$this->getPageVolume();
    }

    /** {@inheritdoc} */
    public function __toString()
    {
        return $this->getDescription();
    }

    /**
     * Return todas las maquinas asociadas a una pieza.
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
        $machine->addPart($this);
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
        $machine->removePart($this);
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

    /**
     * @return boolean
     */
    function isDeletable() {
        return $this->getMachines()->isEmpty();
    }
}