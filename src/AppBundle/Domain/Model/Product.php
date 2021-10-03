<?php

namespace AppBundle\Domain\Model;

use DateTime;
use Exception;

/**
 * Class Product
 * @package AppBundle\Entity
 */
class Product {

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
     * @var int
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
     * Product constructor.
     *
     * @param int    $id
     * @param string $cod
     * @param string $nombre
     * @param float  $price
     * @param int    $taxes
     *
     * @throws Exception
     */
    public function __construct(int $id, string $cod, string $nombre, float $price, int $taxes) {
        $this->updateAt = new DateTime();
        $this->setEnabled(TRUE);
        $this->id = $id;
        $this->cod = $cod;
        $this->price = $price;
        $this->taxes = $taxes;
        $this->nombre = $nombre;
        $this->setCloud(false);
        $this->setWifi(false);
        $this->setNfc(false);
        $this->setAirPrint(false);
    }

    /**
     * @return int
     */
    public function id() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCod() {
        return $this->cod;
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
     * @return bool
     */
    public function isEnabled() {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    /**
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }


    /**
     * @return int
     */
    public function getTaxes() {
        return $this->taxes;
    }    

    /** {@inheritdoc} */
    public function __toString() {
        return $this->getDescription();
    }

    /**
     * @return string
     */
    public function getImageFront() {
        return $this->imageFront;
    }

    /**
     * @param string $imageFront
     */
    public function setImageFront($imageFront) {
        $this->imageFront = $imageFront;
    }

    /**
     * @return string
     */
    public function getImageLateral() {
        return $this->imageLateral;
    }

    /**
     * @param string $imageLateral
     */
    public function setImageLateral($imageLateral) {
        $this->imageLateral = $imageLateral;
    }

    /**
     * @return string
     */
    public function getImagePerspective() {
        return $this->imagePerspective;
    }

    /**
     * @param string $imagePerspective
     */
    public function setImagePerspective($imagePerspective) {
        $this->imagePerspective = $imagePerspective;
    }

    /**
     * @return string
     */
    public function getSubtitle() {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
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
    public function getNombre()
    {
        return $this->nombre;
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
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

}