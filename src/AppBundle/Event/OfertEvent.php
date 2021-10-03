<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 21/08/2017
 * Time: 16:08
 */

namespace AppBundle\Event;


use AppBundle\Entity\Machine;
use AppBundle\Entity\SalesOrder;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class OfertEvent
 * @package AppBundle\Event
 */
class OfertEvent extends Event
{
    /**
     * @var Machine
     */
    private $machine;

    /**
     * @var
     */
    private $duration;

    /**
     * @var
     */
    private $pages;

    /**
     * @var
     */
    private $colorPercent;

    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $address;

    /**
     * @var \AppBundle\Entity\SalesOrder|null
     */
    private $parent;

    /**
     * @var
     */
    private $profitDuration;

    /**
     * OfertEvent constructor.
     *
     * @param Machine $machine
     * @param $duration
     * @param $profitDuration
     * @param $pages
     * @param $colorPercent
     * @param $address
     * @param SalesOrder|null $parent
     */
    public function __construct(Machine $machine, $duration, $profitDuration, $pages, $colorPercent, $address, SalesOrder $parent = null)
    {
        $this->machine = $machine;
        $this->duration = $duration;
        $this->pages = $pages;
        $this->colorPercent = $colorPercent;
        $this->address = $address;
        $this->parent = $parent;
        $this->profitDuration = $profitDuration;
    }

    /**
     * @return Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return string
     */
    public function getColorPercent()
    {
        return $this->colorPercent;
    }

    /**
     * @return null|string
     */
    public function getMachineChromaName()
    {
        if (!$this->getMachine() || !$this->getMachine()->getChromaType()) {

            return null;
        }

        return $this->getMachine()->getChromaType()->getDescription();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent) {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getProfitDuration() {
        return $this->profitDuration;
    }
}