<?php


namespace AppBundle\Application\Service\Dto;


class StoreOrderDTO extends BaseStoreOrderDTO
{
    /**
     * @var null|string
     */
    private $name;

    /**
     * @var null|string
     */
    private $cif;

    /**
     * @var null|string
     */
    private $address;

    /**
     * @var null|string
     */
    private $town;

    /**
     * @var null|string
     */
    private $province;

    /**
     * @var null|string
     */
    private $cp;

    /**
     * @var null|string
     */
    private $phone;

    /**
     * @var null|string
     */
    private $email;

    /**
     * @var null|string
     */
    private $state;

    /**
     * @var null|array
     */
    private $descrition;

    /**
     * @var null|string
     */
    private $deliveryAddress;

    /**
     * @var null|string
     */
    private $deliveryTown;

    /**
     * @var null|string
     */
    private $deliveryProvince;

    /**
     * @var null|string
     */
    private $deliveryCp;

    /**
     * @var string
     */
    private $contactName;

    /**
     * @var bool
     */
    private $aceptarComunicacion;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getCif(): ?string
    {
        return $this->cif;
    }

    /**
     * @param string|null $cif
     */
    public function setCif(?string $cif): void
    {
        $this->cif = $cif;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getTown(): ?string
    {
        return $this->town;
    }

    /**
     * @param string|null $town
     */
    public function setTown(?string $town): void
    {
        $this->town = $town;
    }

    /**
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @param string|null $province
     */
    public function setProvince(?string $province): void
    {
        $this->province = $province;
    }

    /**
     * @return string|null
     */
    public function getCp(): ?string
    {
        return $this->cp;
    }

    /**
     * @param string|null $cp
     */
    public function setCp(?string $cp): void
    {
        $this->cp = $cp;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return array|null
     */
    public function getDescrition(): ?array
    {
        return $this->descrition;
    }

    /**
     * @param array|null $descrition
     */
    public function setDescrition(?array $descrition): void
    {
        $this->descrition = $descrition;
    }

    /**
     * @return string|null
     */
    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string|null $deliveryAddress
     */
    public function setDeliveryAddress(?string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return string|null
     */
    public function getDeliveryTown(): ?string
    {
        return $this->deliveryTown;
    }

    /**
     * @param string|null $deliveryTown
     */
    public function setDeliveryTown(?string $deliveryTown): void
    {
        $this->deliveryTown = $deliveryTown;
    }

    /**
     * @return string|null
     */
    public function getDeliveryProvince(): ?string
    {
        return $this->deliveryProvince;
    }

    /**
     * @param string|null $deliveryProvince
     */
    public function setDeliveryProvince(?string $deliveryProvince): void
    {
        $this->deliveryProvince = $deliveryProvince;
    }

    /**
     * @return string|null
     */
    public function getDeliveryCp(): ?string
    {
        return $this->deliveryCp;
    }

    /**
     * @param string|null $deliveryCp
     */
    public function setDeliveryCp(?string $deliveryCp): void
    {
        $this->deliveryCp = $deliveryCp;
    }

    /**
     * @return string|null
     */
    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    /**
     * @param string|null $contactName
     */
    public function setContactName(?string $contactName): void
    {
        $this->contactName = $contactName;
    }

    /**
     * @return bool
     */
    public function isAceptarComunicacion(): ?bool
    {
        return $this->aceptarComunicacion;
    }

    /**
     * @param bool $aceptarComunicacion
     */
    public function setAceptarComunicacion(?bool $aceptarComunicacion): void
    {
        $this->aceptarComunicacion = $aceptarComunicacion;
    }


}