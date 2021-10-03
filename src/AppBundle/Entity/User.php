<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 */
class User extends BaseUser implements PermittedActionsInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="cif", type="string", nullable=true)
     */
    protected $cif;

    /**
     * @var string
     * @ORM\Column(name="addres", type="string", nullable=true)
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(name="population", type="string", nullable=true)
     */
    protected $population;

    /**
     * @var string
     * @ORM\Column(name="province", type="string", nullable=true)
     */
    protected $province;

    /**
     * @var string
     * @ORM\Column(name="cp", type="string", nullable=true)
     */
    protected $cp;

    /**
     * @var string
     * @ORM\Column(name="owner_name", type="string", nullable=true)
     */
    protected $owner;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", nullable=true)
     */
    protected $phone;

    /**
     * @var string
     * @ORM\Column(name="iban_code", type="string", nullable=true)
     */
    protected $ibanCode;

    /**
     * @var string
     * @ORM\Column(name="card_number", type="string", nullable=true)
     */
    protected $cardNumber;

    /**
     * @var string
     * @ORM\Column(name="card_expiration", type="string", nullable=true)
     */
    protected $cardExpiration;

    /**
     * @var string
     * @ORM\Column(name="card_code", type="string", nullable=true)
     */
    protected $cardCode;

    /**
     * @var string
     * @ORM\Column(name="id_ndd", type="string", nullable=true)
     */
    protected $idNdd;

    /**
     * @var string
     * @ORM\Column(name="password_ndd", type="string", nullable=true)
     */
    protected $passwordNDD;

    /**
     * @var bool
     * @ORM\Column(name="aceptar_comunicacion", type="boolean", nullable=true)
     */
    protected $aceptarComunicacion;

    /**
     * @var SalesOrder []
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SalesOrder", mappedBy="costumer",cascade={"persist"} )
     */
    protected $salesOrder;


    public function __construct()
    {
        parent::__construct();
        $this->salesOrder = new ArrayCollection();
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->enabled = false;
        $this->roles = ['ROLE_USER'];
        $this->aceptarComunicacion = false;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCif()
    {
        return $this->cif;
    }

    /**
     * @param string $cif
     */
    public function setCif($cif)
    {
        $this->cif = $cif;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return string
     */
    public function getCardExpiration()
    {
        return $this->cardExpiration;
    }

    /**
     * @param string $cardExpiration
     */
    public function setCardExpiration($cardExpiration)
    {
        $this->cardExpiration = $cardExpiration;
    }

    /**
     * @return string
     */
    public function getCardCode()
    {
        return $this->cardCode;
    }

    /**
     * @param string $cardCode
     */
    public function setCardCode($cardCode)
    {
        $this->cardCode = $cardCode;
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getIbanCode()
    {
        return $this->ibanCode;
    }

    /**
     * @param string $ibanCode
     */
    public function setIbanCode($ibanCode)
    {
        $this->ibanCode = $ibanCode;
    }

    /**
     * @return string
     */
    public function getIdNdd() {
        return $this->idNdd;
    }

    /**
     * @param string $idNdd
     */
    public function setIdNdd($idNdd) {
        $this->idNdd = $idNdd;
    }

    /**
     * @return string
     */
    public function getPasswordNDD() {
        return $this->passwordNDD;
    }

    /**
     * @param string $passwordNDD
     */
    public function setPasswordNDD($passwordNDD) {
        $this->passwordNDD = $passwordNDD;
    }

    /**
     * (Owning side).
     *
     * @param SalesOrder $salesOrder
     */
    public function addSalesOrder($salesOrder)
    {
        if ($this->salesOrder->contains($salesOrder)) {
            return;
        }

        $this->salesOrder->add($salesOrder);
    }

    /**
     * (Owning side).
     *
     * @param SalesOrder $salesOrder
     */
    public function removeSalesOrder($salesOrder) {
        if (!$this->salesOrder->contains($salesOrder)) {
            return;
        }

        $this->salesOrder->removeElement($salesOrder);
    }

    /**
     * @return SalesOrder[]|ArrayCollection
     */
    public function getSalesOrder() {
        return $this->salesOrder;
    }

    /**
     * @param SalesOrder[] $salesOrder
     */
    public function setInvoices($salesOrder) {
        foreach ($this->getSalesOrder() as $item) {
            $this->removeSalesOrder($item);
        }
        foreach ($salesOrder as $item) {
            $this->addSalesOrder($item);
        }
    }

    /**
     * @return string
     */
    public function getCp() {
        return $this->cp;
    }

    /**
     * @param string $cp
     */
    public function setCp($cp) {
        $this->cp = $cp;
    }

    /**
     * @return string
     */
    public function getPopulation() {
        return $this->population;
    }

    /**
     * @param string $population
     */
    public function setPopulation($population) {
        $this->population = $population;
    }

    /**
     * @return string
     */
    public function getProvince() {
        return $this->province;
    }

    /**
     * @param string $province
     */
    public function setProvince($province) {
        $this->province = $province;
    }

    /**
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    /**
     * @return boolean
     */
    function isDeletable() {
        return $this->getSalesOrder()->isEmpty() && !$this->hasRole('ROLE_SUPER_ADMIN');
    }

    /**
     * @return bool
     */
    public function isAceptarComunicacion(): bool
    {
        return $this->aceptarComunicacion;
    }

    /**
     * @param bool $aceptarComunicacion
     */
    public function setAceptarComunicacion(bool $aceptarComunicacion): void
    {
        $this->aceptarComunicacion = $aceptarComunicacion;
    }
}