<?php


namespace AppBundle\Application\Service\Dto;


use DateTime;

class CartProductDTO extends CartProductBaseDTO
{
    /**
     * @var string
     */
    protected $cod;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $subtitle;

    /**
     * @var boolean
     */
    protected $enabled = FALSE;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $totalPrice;

    /**
     * @var int
     */
    protected $taxes;

    /**
     * @var string
     */
    protected $imageFront;

    /**
     * @var string
     */
    protected $imageLateral;

    /**
     * @var string
     */
    protected $imagePerspective;

    /**
     * @var DateTime
     */
    protected $updateAt;

    /**
     * @var boolean
     */
    protected $airPrint;

    /**
     * @var boolean
     */
    protected $cloud;

    /**
     * @var boolean
     */
    protected $wifi;

    /**
     * @var boolean
     */
    protected $nfc;

    /**
     * @var string|null
     */
    protected $sheet;

    /**
     * @var int|null
     */
    protected $quantity;

    /**
     * @var float|null
     */
    protected $total;

    /**
     * CartProductBaseDTP constructor.
     * @param int $id
     * @param int $qtty
     */
    public function __construct(int $id, int $qtty)
    {
        parent::__construct($id, $qtty);
        $this->subtitle = '';
    }

    /**
     * @return string
     */
    public function getCod(): string
    {
        return $this->cod;
    }

    /**
     * @param string $cod
     */
    public function setCod(string $cod): void
    {
        $this->cod = $cod;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getTaxes(): int
    {
        return $this->taxes;
    }

    /**
     * Function setTaxes
     *
     * @param int $taxes
     *
     * @return void
     */
    public function setTaxes(int $taxes)
    {
        $this->taxes = $taxes;
    }

    /**
     * @return string
     */
    public function getImageFront(): string
    {
        return $this->imageFront;
    }

    /**
     * @param string $imageFront
     */
    public function setImageFront(string $imageFront): void
    {
        $this->imageFront = $imageFront;
    }

    /**
     * @return string
     */
    public function getImageLateral(): string
    {
        return $this->imageLateral;
    }

    /**
     * @param string $imageLateral
     */
    public function setImageLateral(string $imageLateral): void
    {
        $this->imageLateral = $imageLateral;
    }

    /**
     * @return string
     */
    public function getImagePerspective(): string
    {
        return $this->imagePerspective;
    }

    /**
     * @param string $imagePerspective
     */
    public function setImagePerspective(string $imagePerspective): void
    {
        $this->imagePerspective = $imagePerspective;
    }

    /**
     * @return DateTime
     */
    public function getUpdateAt(): DateTime
    {
        return $this->updateAt;
    }

    /**
     * @param DateTime $updateAt
     */
    public function setUpdateAt(DateTime $updateAt): void
    {
        $this->updateAt = $updateAt;
    }

    /**
     * @return bool
     */
    public function isAirPrint(): bool
    {
        return $this->airPrint;
    }

    /**
     * @param bool $airPrint
     */
    public function setAirPrint(bool $airPrint): void
    {
        $this->airPrint = $airPrint;
    }

    /**
     * @return bool
     */
    public function isCloud(): bool
    {
        return $this->cloud;
    }

    /**
     * @param bool $cloud
     */
    public function setCloud(bool $cloud): void
    {
        $this->cloud = $cloud;
    }

    /**
     * @return bool
     */
    public function isWifi(): bool
    {
        return $this->wifi;
    }

    /**
     * @param bool $wifi
     */
    public function setWifi(bool $wifi): void
    {
        $this->wifi = $wifi;
    }

    /**
     * @return bool
     */
    public function isNfc(): bool
    {
        return $this->nfc;
    }

    /**
     * @param bool $nfc
     */
    public function setNfc(bool $nfc): void
    {
        $this->nfc = $nfc;
    }

    /**
     * @return string|null
     */
    public function getSheet(): ?string
    {
        return $this->sheet;
    }

    /**
     * @param string|null $sheet
     */
    public function setSheet(?string $sheet): void
    {
        $this->sheet = $sheet;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float|null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param float|null $total
     */
    public function setTotal(?float $total): void
    {
        $this->total = $total;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }
}