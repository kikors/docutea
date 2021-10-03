<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ProductForPersistenceRepository")
 * @Vich\Uploadable
 */
class ProductForPersistence implements PermittedActionsInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="cod", type="string", nullable=false)
     */
    protected $cod;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(name="nombre", type="string", nullable=false)
     */
    protected $nombre;

    /**
     * @var string
     * @ORM\Column(name="subtitle", type="string", nullable=true)
     */
    protected $subtitle;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $enabled = FALSE;

    /**
     * @var float
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    protected $price;


    /**
     * @var int
     * @ORM\Column(name="taxes", type="integer", nullable=true)
     */
    protected $taxes;

    /**
     * It only stores the name of the image associated with the product.
     *
     * @ORM\Column(name="image_front", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageFront;

    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="imageFront")
     *
     * @var File
     */
    private $imageFrontFile;

    /**
     * It only stores the name of the image associated with the product.
     *
     * @ORM\Column(name="image_lateral", type="string", length=255,
     *     nullable=true)
     *
     * @var string
     */
    private $imageLateral;

    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="imageLateral")
     *
     * @var File
     */
    private $imageLateralFile;

    /**
     * It only stores the name of the image associated with the product.
     *
     * @ORM\Column(name="image_perspective", type="string", length=255,
     *   nullable=true)
     *
     * @var string
     */
    private $imagePerspective;

    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="imagePerspective")
     *
     * @var File
     */
    private $imagePerspectiveFile;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="air_print", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $airPrint;

    /**
     * @ORM\Column(name="cloud", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $cloud;

    /**
     * @ORM\Column(name="wifi", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $wifi;

    /**
     * @ORM\Column(name="nfc", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $nfc;

    /**
     * @ORM\Column(name="sheet", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $sheet;

    /**
     * This unmapped property stores the binary contents of the sheet file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="sheet_file", fileNameProperty="sheet")
     *
     * @var File
     */
    private $sheetFile;

    /**
     * Machine constructor.
     */
    public function __construct() {
        $this->updatedAt = new DateTime('now');
        $this->setEnabled(true);
        $this->setCloud(false);
        $this->setWifi(false);
        $this->setNfc(false);
        $this->setAirPrint(false);
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
    public function getCod() {
        return $this->cod;
    }

    /**
     * @param string $cod
     */
    public function setCod($cod) {
        $this->cod = $cod;
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
     * @param float $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }


    /**
     * @return int
     */
    public function getTaxes() {
        return $this->taxes;
    }

    /**
     * @param int $taxes
     */
    public function setTaxes($taxes) {
        $this->taxes = $taxes;
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
     * @return File
     */
    public function getImageFrontFile() {
        return $this->imageFrontFile;
    }

    /**
     * @param File|NULL $imageFrontFile
     * @throws Exception
     */
    public function setImageFrontFile(File $imageFrontFile = NULL) {
        $this->imageFrontFile = $imageFrontFile;
        if ($imageFrontFile) {
            $this->updatedAt = new DateTime('now');
        }
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
     * @return File
     */
    public function getImageLateralFile() {
        return $this->imageLateralFile;
    }

    /**
     * @param File|NULL $imageLateralFile
     * @throws Exception
     */
    public function setImageLateralFile(File $imageLateralFile = NULL) {
        $this->imageLateralFile = $imageLateralFile;
        if ($imageLateralFile) {
            $this->updatedAt = new DateTime('now');
        }
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
     * @return File
     */
    public function getImagePerspectiveFile() {
        return $this->imagePerspectiveFile;
    }

    /**
     * @param File|NULL $imagePerspectiveFile
     * @throws Exception
     */
    public function setImagePerspectiveFile(File $imagePerspectiveFile = NULL) {
        $this->imagePerspectiveFile = $imagePerspectiveFile;
        if ($imagePerspectiveFile) {
            $this->updatedAt = new DateTime('now');
        }

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
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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
     * @return File
     */
    public function getSheetFile() {
        return $this->sheetFile;
    }

    /**
     * @param File|UploadedFile $sheetFile
     * @throws Exception
     */
    public function setSheetFile(File $sheetFile = NULL) {
        $this->sheetFile = $sheetFile;
        if ($sheetFile) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @return string
     */
    public function getSheet(): ?string
    {
        return $this->sheet;
    }

    /**
     * @param string $sheet
     */
    public function setSheet(?string $sheet): void
    {
        $this->sheet = $sheet;
    }
}