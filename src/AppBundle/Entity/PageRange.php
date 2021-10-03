<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="page_range")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PageRangeRepository")
 */
class PageRange
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
     * @var string
     * @ORM\Column(name="start", type="integer", nullable=false)
     */
    protected $start;

    /**
     * @var string
     * @ORM\Column(name="end", type="integer", nullable=false)
     */
    protected $end;

    /**
     * @var bool
     * @ORM\Column(name="default_value", type="boolean", nullable=false)
     */
    protected $default;

    /**
     * PageRange constructor.
     */
    public function __construct()
    {
        $this->default = false;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * @param string $start
     */
    public function setStart($start) {
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * @param string $end
     */
    public function setEnd($end) {
        $this->end = $end;
    }

    /**
     * @return bool
     */
    public function isDefault() {
        return $this->default;
    }

    /**
     * @param bool $default
     */
    public function setDefault($default) {
        $this->default = $default;
    }

    /** {@inheritdoc} */
    public function __toString()
    {
        return $this->getDescription();
    }
}