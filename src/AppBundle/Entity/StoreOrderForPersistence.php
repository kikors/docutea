<?php


namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="store_order")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\StoreOrderForPersistenceRepository")
 */
class StoreOrderForPersistence implements PermittedActionsInterface
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="transact_id", type="string", nullable=false)
     */
    private $transactId;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="cif", type="string", nullable=false)
     */
    private $cif;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", nullable=false)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="town", type="string", nullable=true)
     */
    private $town;

    /**
     * @var string
     * @ORM\Column(name="province", type="string", nullable=false)
     */
    private $province;

    /**
     * @var string
     * @ORM\Column(name="cp", type="string", nullable=false)
     */
    private $cp;

    /**
     * @var string
     * @ORM\Column(name="contact_name", type="string", nullable=true)
     */
    private $contactName;

    /**
     * @var string
     * @ORM\Column(name="delivery_address", type="string", nullable=true)
     */
    private $deliveryAddress;

    /**
     * @var string
     * @ORM\Column(name="delivery_town", type="string", nullable=true)
     */
    private $deliveryTown;

    /**
     * @var string
     * @ORM\Column(name="delivery_province", type="string", nullable=true)
     */
    private $deliveryProvince;

    /**
     * @var string
     * @ORM\Column(name="delivery_cp", type="string", nullable=true)
     */
    private $deliveryCp;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", nullable=false)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * @var null|string
     * @ORM\Column(name="idTpv", type="string", nullable=true)
     */
    private $idTpv;

    /**
     * @var null|DateTime
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *  @ORM\Column(name="state", type="string", nullable=false)
     */
    private $state;

    /**
     * @var float
     *  @ORM\Column(name="amount", type="float", nullable=false)
     */
    private $amount;

    /**
     * @var null|string
     *  @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @var null|bool
     *  @ORM\Column(name="aceptar_comunicacion", type="boolean", nullable=true)
     */
    private $aceptarComunicacion;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCif(): string
    {
        return $this->cif;
    }

    /**
     * @param string $cif
     */
    public function setCif(string $cif): void
    {
        $this->cif = $cif;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @param string $town
     */
    public function setTown(string $town): void
    {
        $this->town = $town;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @param string $province
     */
    public function setProvince(string $province): void
    {
        $this->province = $province;
    }

    /**
     * @return string
     */
    public function getCp(): string
    {
        return $this->cp;
    }

    /**
     * @param string $cp
     */
    public function setCp(string $cp): void
    {
        $this->cp = $cp;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getIdTpv(): ?string
    {
        return $this->idTpv;
    }

    /**
     * @param string|null $idTpv
     */
    public function setIdTpv(?string $idTpv): void
    {
        $this->idTpv = $idTpv;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime|null $date
     */
    public function setDate(?DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTransactId(): string
    {
        return $this->transactId;
    }

    /**
     * @param string $transactId
     */
    public function setTransactId(string $transactId): void
    {
        $this->transactId = $transactId;
    }


    /**
     * @return boolean
     */
    function isDeletable()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $deliveryAddress
     */
    public function setDeliveryAddress(?string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return string
     */
    public function getDeliveryTown(): ?string
    {
        return $this->deliveryTown;
    }

    /**
     * @param string $deliveryTown
     */
    public function setDeliveryTown(?string $deliveryTown): void
    {
        $this->deliveryTown = $deliveryTown;
    }

    /**
     * @return string
     */
    public function getDeliveryProvince(): ?string
    {
        return $this->deliveryProvince;
    }

    /**
     * @param string $deliveryProvince
     */
    public function setDeliveryProvince(?string $deliveryProvince): void
    {
        $this->deliveryProvince = $deliveryProvince;
    }

    /**
     * @return string
     */
    public function getDeliveryCp(): ?string
    {
        return $this->deliveryCp;
    }

    /**
     * @param string $deliveryCp
     */
    public function setDeliveryCp(?string $deliveryCp): void
    {
        $this->deliveryCp = $deliveryCp;
    }

    /**
     * @return string
     */
    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    /**
     * @param string $contactName
     */
    public function setContactName(?string $contactName): void
    {
        $this->contactName = $contactName;
    }

    /**
     * @return bool|null
     */
    public function getAceptarComunicacion(): ?bool
    {
        return $this->aceptarComunicacion;
    }

    /**
     * @param bool|null $aceptarComunicacion
     */
    public function setAceptarComunicacion(?bool $aceptarComunicacion): void
    {
        $this->aceptarComunicacion = $aceptarComunicacion;
    }


}