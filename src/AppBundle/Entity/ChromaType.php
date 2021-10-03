<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="chroma_type")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ChromaTypeRepository")
 */
class ChromaType
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
     * @var bool
     * @ORM\Column(name="default_value", type="boolean", nullable=false)
     */
    protected $default;

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
}