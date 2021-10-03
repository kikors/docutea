<?php


namespace AppBundle\Application\Service\Dto;


use DateTime;
use Exception;

class ProductDTO
{
    /**
     * @var int
     */
    protected $id;

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
     * @var integer
     */
    protected $taxes;

    /**
     * @var string
     */
    private $imageFront;

    /**
     * @var string
     */
    private $imageLateral;

    /**
     * @var string
     */
    private $imagePerspective;

    /**
     * @var DateTime
     */
    private $updateAt;

    /**
     * @var boolean
     */
    private $airPrint;

    /**
     * @var boolean
     */
    private $cloud;

    /**
     * @var boolean
     */
    private $wifi;

    /**
     * @var boolean
     */
    private $nfc;

    /**
     * @var string|null
     */
    private $sheet;

    /**
     * ProductDTO constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = 0;
        $this->cod = '';
        $this->description = '';
        $this->nombre = '';
        $this->subtitle = '';
        $this->enabled = true;
        $this->price = 0;
        $this->taxes = 0;
        $this->imageFront = '';
        $this->imageLateral = '';
        $this->imagePerspective = '';
        $this->updateAt = new DateTime();
        $this->cloud = false;
        $this->wifi = false;
        $this->nfc = false;
        $this->airPrint = false;
        $this->sheet = '';
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
    public function getTaxes()
    {
        return $this->taxes;
    }

    /**
     * @param int $taxes
     */
    public function setTaxes(int $taxes): void
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
}