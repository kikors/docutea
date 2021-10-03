<?php


namespace AppBundle\Application\Service\Dto;


use DateTime;

class BaseStoreOrderDTO
{
    /**
     * @var null|string
     */
    private $id;

    /**
     * @var null|string
     */
    private $idTpv;

    /**
     * @var null|DateTime
     */
    private $date;

    /**
     * @var null|float
     */
    private $amount;

    /**
     * BaseStoreOrderDTO constructor.
     * @param string $id
     * @param string $idTpv
     * @param DateTime $date
     * @param float $amount
     */
    public function __construct(string $id = null, string $idTpv = null, DateTime $date = null, float $amount = null)
    {
        $this->id = $id;
        $this->idTpv = $idTpv;
        $this->date = $date;
        $this->amount = $amount;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getIdTpv(): ?string
    {
        return $this->idTpv;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param string|null $idTpv
     */
    public function setIdTpv(?string $idTpv): void
    {
        $this->idTpv = $idTpv;
    }

    /**
     * @param float|null $amount
     */
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }
}