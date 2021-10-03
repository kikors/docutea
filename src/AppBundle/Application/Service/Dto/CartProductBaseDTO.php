<?php


namespace AppBundle\Application\Service\Dto;


class CartProductBaseDTO
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $qtty;

    /**
     * CartProductBaseDTP constructor.
     * @param int $id
     * @param int $qtty
     */
    public function __construct(int $id, int $qtty)
    {
        $this->id = $id;
        $this->qtty = $qtty;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function qtty(): int
    {
        return $this->qtty;
    }
}