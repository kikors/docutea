<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="care_pack_profit")
 * * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CarePackProfitRepository")
 */
class CarePackProfit
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(name="duration", type="string", nullable=false)
     */
    protected $duration;

    /**
     * @var float
     * @ORM\Column(name="profit", type="string", nullable=false)
     */
    protected $profit;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * @param float $profit
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;
    }
}