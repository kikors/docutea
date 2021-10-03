<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contract_time")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ContractTimeRepository")
 */
class ContractTime
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     * @ORM\Column(name="durationInMonths", type="integer", nullable=false)
     */
    protected $durationInMonths;

    /**
     * @var bool
     * @ORM\Column(name="default", type="boolean", nullable=false)
     */
    protected $default;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /** {@inheritdoc} */
    public function __toString()
    {
        return strval($this->getDurationInMonths());
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @param bool $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * @return int
     */
    public function getDurationInMonths()
    {
        return $this->durationInMonths;
    }

    /**
     * @param int $durationInMonths
     */
    public function setDurationInMonths($durationInMonths)
    {
        $this->durationInMonths = $durationInMonths;
    }


}