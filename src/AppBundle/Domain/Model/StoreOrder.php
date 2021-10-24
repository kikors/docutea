<?php


namespace AppBundle\Domain\Model;


use AppBundle\StaticsClass\StateStoreOrder;
use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * Class StoreOrder
 * @package AppBundle\Domain\Model
 */
class StoreOrder
{
    const ID_TRANSACT_MAX_LENGTH = 8;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $transactId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cif;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $cp;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var null|string
     */
    private $idTpv;

    /**
     * @var null|DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $state;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $descrition;

    /**
     * @var string
     */
    private $deliveryAddress;

    /**
     * @var string
     */
    private $deliveryTown;

    /**
     * @var string
     */
    private $deliveryProvince;

    /**
     * @var string
     */
    private $deliveryCp;

    /**
     * @var string|null
     */
    private $contactName;

    /**
     * @var bool
     */
    private $aceptarComunicacion;

    /**
     * StoreOrder constructor.
     * @param string|null $id
     * @throws Exception
     */
    public function __construct(string $id = null)
    {
        if (!$id) {
            $id = Uuid::uuid1();
        }
        $this->id = $id;
        $this->transactId = date('Y').substr($id, 0, self::ID_TRANSACT_MAX_LENGTH);
        $this->aceptarComunicacion = false;
    }

    /**
     * @param string $name
     * @param string $cif
     * @param string $address
     * @param string $province
     * @param string $cp
     * @param string $phone
     * @param string $email
     * @param string|null $town
     */
    public function configureUserData(
        string $name, string $cif, string $address, string $province,
        string $cp, string $phone, string $email, ?string $town = null
    ): void
    {
        $this->name = $name;
        $this->cif = $cif;
        $this->address = $address;
        $this->province = $province;
        $this->cp =$cp;
        $this->phone = $phone;
        $this->email = $email;
        $this->town = $town;
    }

    public function configureDeliveryAddress(
        ?string $contactName, ?string $address, ?string $province, ?string $cp, ?string $town = null
    ): void
    {
        $this->deliveryAddress = $address;
        $this->deliveryProvince = $province;
        $this->deliveryCp =$cp;
        $this->deliveryTown = $town;
        $this->contactName = $contactName;
    }

    /**
     * @param string|null $idTpv
     * @param float $amount
     * @param DateTime|null $date
     * @param string $description
     */
    public function configureTransactionData(
        ?string $idTpv, float $amount, ?DateTime $date, string $description
    ): void
    {
        $this->idTpv = $idTpv;
        $this->amount = $amount;
        $this->descrition = $description;
        $this->date = $date;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     *
     */
    public function denied(): void
    {
       $this->state = StateStoreOrder::DENIED;
    }

    /**
     *
     */
    public function success(): void
    {
        $this->state = StateStoreOrder::SUCCESS;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCif(): string
    {
        return $this->cif;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getCp(): string
    {
        return $this->cp;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getId(): string
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
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDescrition(): string
    {
        return $this->descrition;
    }

    /**
     * @return string
     */
    public function getTransactId(): string
    {
        return $this->transactId;
    }

    /**
     * @param string|null $idTpv
     */
    public function setIdTpv(?string $idTpv): void
    {
        $this->idTpv = $idTpv;
    }

    /**
     * @param DateTime|null $date
     */
    public function setDate(?DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    /**
     * @return string
     */
    public function getDeliveryTown(): ?string
    {
        return $this->deliveryTown;
    }

    /**
     * @return string
     */
    public function getDeliveryProvince(): ?string
    {
        return $this->deliveryProvince;
    }

    /**
     * @return string
     */
    public function getDeliveryCp(): ?string
    {
        return $this->deliveryCp;
    }

    /**
     * @return string|null
     */
    public function getContactName(): ?string
    {
        return $this->contactName;
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