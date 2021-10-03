<?php

namespace AppBundle\Entity;

use AppBundle\StaticsClass\TonerColors;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="machine")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\MachineRepository")
 * @Vich\Uploadable
 */
class Machine implements PermittedActionsInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="cod", type="string", nullable=true)
     */
    protected $cod;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(name="subtitle", type="text", nullable=true)
     */
    protected $subtitle;

    /**
     * @var FunctionalityType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FunctionalityType")
     */
    protected $functionality;

    /**
     * @var FormatType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FormatType")
     */
    protected $format;

    /**
     * @var ChromaType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ChromaType")
     */
    protected $chromaType;

    /**
     * @var CarePack
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CarePack", inversedBy="machines")
     */
    protected $carePack;

    /**
     * @var Maker
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Maker")
     */
    protected $maker;

    /**
     * @var Technology
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Technology")
     */
    protected $technology;

    /**
     * @var integer
     * @ORM\Column(name="recom_volume", type="integer", nullable=true)
     */
    protected $recomendedVolume;

    /**
     * @var integer
     * @ORM\Column(name="print_speed", type="integer", nullable=true)
     */
    protected $printSpeed;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $enabled = FALSE;

    /**
     * @var string
     * @ORM\Column(name="aditional_main_info", type="text", nullable=true)
     */
    protected $aditionalMainInfo;

    /**
     * @var string
     * @ORM\Column(name="aditional_info", type="text", nullable=true)
     */
    protected $aditionalInfo;

    /**
     * @var PageRange
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PageRange")
     */
    protected $pageRange;

    /**
     * @var float
     * @ORM\Column(name="price", type="float")
     */
    protected $price;

    /**
     * @var float
     * @ORM\Column(name="profit", type="float")
     */
    protected $profit;

    /**
     * @var float
     * @ORM\Column(name="instalation_price", type="float")
     */
    protected $instalationPrice;

    /**
     * @var float
     * @ORM\Column(name="monitorization_price", type="float")
     */
    protected $monitorizationPrice;

    /**
     * Lista de toners
     * (Owning side).
     *
     * @var Toner[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Toner", inversedBy="machines")
     * @ORM\JoinTable(name="machine_toner")
     */
    private $toners;

    /**
     * Lista de toners
     * (Owning side).
     *
     * @var Drum[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Drum", inversedBy="machines")
     * @ORM\JoinTable(name="machine_drum")
     */
    private $drums;

    /**
     * Lista de piezas
     * (Owning side).
     *
     * @var Part[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Part", inversedBy="machines")
     * @ORM\JoinTable(name="machine_part")
     */
    private $parts;

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
     * @var bool
     * @ORM\Column(name="recomended", type="boolean")
     */
    protected $recomended;

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
     * @var float
     * @ORM\Column(name="page_profit", type="float")
     */
    protected $pageProfit;

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
     * @var \AppBundle\Entity\StockType
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\StockType")
     */
    protected $stock;

    /**
     * @var \AppBundle\Entity\SalesOrder []
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SalesOrder", mappedBy="machine")
     */
    protected $salesOrders;

    /**
     * Machine constructor.
     */
    public function __construct() {
        $this->toners = new ArrayCollection();
        $this->salesOrders = new ArrayCollection();
        $this->parts = new ArrayCollection();
        $this->drums = new ArrayCollection();
        $this->setEnabled(TRUE);
        $this->setRecomended(FALSE);
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
     * @return FunctionalityType
     */
    public function getFunctionality() {
        return $this->functionality;
    }

    /**
     * @param FunctionalityType $functionality
     */
    public function setFunctionality($functionality) {
        $this->functionality = $functionality;
    }

    /**
     * @return FormatType
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @param FormatType $format
     */
    public function setFormat($format) {
        $this->format = $format;
    }

    /**
     * @return ChromaType
     */
    public function getChromaType() {
        return $this->chromaType;
    }

    /**
     * @param ChromaType $chromaType
     */
    public function setChromaType($chromaType) {
        $this->chromaType = $chromaType;
    }

    /**
     * @return Maker
     */
    public function getMaker() {
        return $this->maker;
    }

    /**
     * @param Maker $maker
     */
    public function setMaker($maker) {
        $this->maker = $maker;
    }

    /**
     * @return Technology
     */
    public function getTechnology() {
        return $this->technology;
    }

    /**
     * @param Technology $technology
     */
    public function setTechnology($technology) {
        $this->technology = $technology;
    }

    /**
     * @return int
     */
    public function getRecomendedVolume() {
        return $this->recomendedVolume;
    }

    /**
     * @param int $recomendedVolume
     */
    public function setRecomendedVolume($recomendedVolume) {
        $this->recomendedVolume = $recomendedVolume;
    }

    /**
     * @return int
     */
    public function getPrintSpeed() {
        return $this->printSpeed;
    }

    /**
     * @param int $printSpeed
     */
    public function setPrintSpeed($printSpeed) {
        $this->printSpeed = $printSpeed;
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
     * @return string
     */
    public function getAditionalInfo() {
        return $this->aditionalInfo;
    }

    /**
     * @param string $aditionalInfo
     */
    public function setAditionalInfo($aditionalInfo) {
        $this->aditionalInfo = $aditionalInfo;
    }

    /**
     * @return PageRange
     */
    public function getPageRange() {
        return $this->pageRange;
    }

    /**
     * @param PageRange $pageRange
     */
    public function setPageRange($pageRange) {
        $this->pageRange = $pageRange;
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

    /** {@inheritdoc} */
    public function __toString() {
        return $this->getDescription();
    }

    /**
     * Adiciona un tonera una maquina.
     * (Owning side).
     *
     * @param $toner Toner el toner que se va a asociar
     */
    public function addToner($toner) {
        if ($this->toners->contains($toner)) {
            return;
        }

        $this->toners->add($toner);
        $toner->addMachine($this);
    }

    /**
     * Elimina un toner.
     * (Owning side).
     *
     * @param $toner Toner el toner a asociar
     */
    public function removeToner($toner) {
        if (!$this->toners->contains($toner)) {
            return;
        }

        $this->toners->removeElement($toner);
        $toner->removeMachine($this);
    }

    /**
     * Retorna todos los toners asociados.
     *
     * @return Toner[]|ArrayCollection
     */
    public function getToners() {
        return $this->toners;
    }

    /**
     * Setea todos los toners.
     *
     * @param Toner[] $toners
     */
    public function setToners($toners) {
        foreach ($this->getToners() as $toner) {
            $this->removeToner($toner);
        }
        foreach ($toners as $toner) {
            $this->addToner($toner);
        }
    }

    /**
     * Adiciona una pieza a una maquina.
     * (Owning side).
     *
     * @param $part Part el toner que se va a asociar
     */
    public function addPart($part) {
        if ($this->parts->contains($part)) {
            return;
        }

        $this->parts->add($part);
        $part->addMachine($this);
    }

    /**
     * Elimina una pieza.
     * (Owning side).
     *
     * @param $part Part el toner a asociar
     */
    public function removePart($part) {
        if (!$this->parts->contains($part)) {
            return;
        }

        $this->parts->removeElement($part);
        $part->removeMachine($this);
    }

    /**
     * Retorna todas las piezas asociados.
     *
     */
    public function getParts() {
        return $this->parts;
    }

    /**
     * Setea todas las piezas.
     *
     * @param Part[] $parts
     */
    public function setParts($parts) {
        foreach ($this->getParts() as $part) {
            $this->removePart($part);
        }
        foreach ($parts as $part) {
            $this->addPart($part);
        }
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
     * @param File|UploadedFile $imageFrontFile
     */
    public function setImageFrontFile(File $imageFrontFile = NULL) {
        $this->imageFrontFile = $imageFrontFile;
        if ($imageFrontFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $date = new DateTime();
            $this->aditionalMainInfo  = $date->getTimestamp();
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
     * @param File $imageLateralFile
     */
    public function setImageLateralFile(File $imageLateralFile = NULL) {
        $this->imageLateralFile = $imageLateralFile;
        if ($imageLateralFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $date = new DateTime();
            $this->aditionalMainInfo  = $date->getTimestamp();
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
     * @param File $imagePerspectiveFile
     */
    public function setImagePerspectiveFile(File $imagePerspectiveFile = NULL) {
        $this->imagePerspectiveFile = $imagePerspectiveFile;
        if ($imagePerspectiveFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $date = new DateTime();
            $this->aditionalMainInfo  = $date->getTimestamp();
        }

    }

    /**
     * @return string
     */
    public function getAditionalMainInfo() {
        return $this->aditionalMainInfo;
    }

    /**
     * @param string $aditionalMainInfo
     */
    public function setAditionalMainInfo($aditionalMainInfo) {
        $this->aditionalMainInfo = $aditionalMainInfo;
    }

    /**
     * @return float
     */
    public function getInstalationPrice() {
        return $this->instalationPrice;
    }

    /**
     * @param float $instalationPrice
     */
    public function setInstalationPrice($instalationPrice) {
        $this->instalationPrice = $instalationPrice;
    }

    /**
     * @return float
     */
    public function getMonitorizationPrice() {
        return $this->monitorizationPrice;
    }

    /**
     * @param float $monitorizationPrice
     */
    public function setMonitorizationPrice($monitorizationPrice) {
        $this->monitorizationPrice = $monitorizationPrice;
    }

    /**
     * @return CarePack
     */
    public function getCarePack() {
        return $this->carePack;
    }

    /**
     * @param CarePack $carePack
     */
    public function setCarePack($carePack) {
        $this->carePack = $carePack;
    }

    /**
     * @return float
     */
    public function getProfit() {
        return $this->profit;
    }

    /**
     * @param float $profit
     */
    public function setProfit($profit) {
        $this->profit = $profit;
    }

    /**
     * @return Drum[]
     */
    public function getDrums() {
        return $this->drums;
    }

    /**
     * @param Drum[] $drums
     */
    public function setDrums($drums) {
        $this->drums = $drums;
    }

    /**
     * Adiciona un tonera una maquina.
     * (Owning side).
     *
     * @param $drum Drum el toner que se va a asociar
     */
    public function addDrum($drum) {
        if ($this->drums->contains($drum)) {
            return;
        }

        $this->toners->add($drum);
        $drum->addMachine($this);
    }

    /**
     * Elimina un toner.
     * (Owning side).
     *
     * @param $drum Drum el toner a asociar
     */
    public function removeDrum($drum) {
        if (!$this->toners->contains($drum)) {
            return;
        }

        $this->toners->removeElement($drum);
        $drum->removeMachine($this);
    }

    /**
     * @return bool
     */
    public function isRecomended() {
        return $this->recomended;
    }

    /**
     * @param bool $recomended
     */
    public function setRecomended($recomended) {
        $this->recomended = $recomended;
    }

    /**
     * @return bool
     */
    public function isAirPrint() {
        return $this->airPrint;
    }

    /**
     * @param bool $airPrint
     */
    public function setAirPrint($airPrint) {
        $this->airPrint = $airPrint;
    }

    /**
     * @return bool
     */
    public function isCloud() {
        return $this->cloud;
    }

    /**
     * @param bool $cloud
     */
    public function setCloud($cloud) {
        $this->cloud = $cloud;
    }

    /**
     * @return bool
     */
    public function isWifi() {
        return $this->wifi;
    }

    /**
     * @param bool $wifi
     */
    public function setWifi($wifi) {
        $this->wifi = $wifi;
    }

    /**
     * @return bool
     */
    public function isNfc() {
        return $this->nfc;
    }

    /**
     * @param bool $nfc
     */
    public function setNfc($nfc) {
        $this->nfc = $nfc;
    }

    /**
     * @return float
     */
    public function getPageProfit() {
        return $this->pageProfit;
    }

    /**
     * @param float $pageProfit
     */
    public function setPageProfit($pageProfit) {
        $this->pageProfit = $pageProfit;
    }

    /**
     * Devuelve true si la máquina es color y false si es blanco y negro
     *
     * @return boolean
     */
    public function isColor() {
        if (strtoupper($this->getChromaType()->getDescription()) === 'COLOR') {

            return TRUE;
        }

        return FALSE;
    }

    /**
     * @return string
     */
    public function getSheet() {
        return $this->sheet;
    }

    /**
     * @param string $sheet
     */
    public function setSheet($sheet) {
        $this->sheet = $sheet;
    }

    /**
     * @return \AppBundle\Entity\StockType
     */
    public function getStock() {
        return $this->stock;
    }

    /**
     * @param \AppBundle\Entity\StockType $stock
     */
    public function setStock($stock) {
        $this->stock = $stock;
    }

    /**
     * @return mixed|array
     * @throws \Exception
     */
    public function __toArray() {
        $result['id'] = $this->getId();
        $result['cod'] = $this->getCod();
        $result['description'] = $this->getDescription();
        $result['functionality'] = $this->getFunctionality()->getId();
        $result['format'] = $this->getFormat()->getId();
        $result['chromaType'] = $this->getChromaType()->getId();
        $result['carePack'] = $this->getCarePack()->getId();
        $result['maker'] = $this->getMaker()->getId();
        $result['technology'] = $this->getTechnology()->getId();
        $result['recomendedVolume'] = $this->recomendedVolume;
        $result['printSpeed'] = $this->getPrintSpeed();
        $result['enabled'] = $this->enabled;
        $result['aditionalMainInfo'] = $this->getAditionalMainInfo();
        $result['aditionalInfo'] = $this->getAditionalInfo();
        $result['price'] = $this->getPrice();
        $result['imageFront'] = $this->getImageFront();
        $result['recomended'] = $this->isRecomended();
        $result['imageLateral'] = $this->getImageLateral();
        $result['imagePerspective'] = $this->getImagePerspective();
        $result['airPrint'] = $this->isAirPrint();
        $result['wifi'] = $this->isWifi();
        $result['cloud'] = $this->isCloud();
        $result['nfc'] = $this->isNfc();
        $result['blackPageCost'] = $this->getBlackPageCost();
        $result['colorPageCost'] = $this->getColorPageCost();
        $result['subtitle'] = $this->getSubtitle();
        $result['aditionalInfo'] = $this->getAditionalInfo();
        $result['sheet'] = $this->getSheet();

        return $result;
    }

    /******************************** Cálculo del coste por pagina *************************************/

    /**
     * Devuelve el costo por pagina del toner
     *
     * @param Toner $toner
     *
     * @return float|int
     * @throws \Exception
     */
    public function getTonerPriceByPage($toner) {
        if (!$toner) {

            return 0;
        }
        if (strtoupper($toner->getColorDescrition()) === strtoupper(TonerColors::BLACK)) {
            return $toner->getCostByPage() + $this->getDrumCostByPage($toner) + $this->getPartPriceByPage();
        }
        return round($toner->getCostByPage() + $this->getDrumCostByPage($toner) + $this->getPartPriceByPage() / $this->getToners()
                ->count(), 5);
    }

    /**
     * Devuelve el costo por pagina de todas las partes menos de los drum
     *
     * @return int|float
     */
    private function getPartPriceByPage() {
        $parts = $this->getParts();
        $result = 0;
        if (!$parts) {

            return 0;
        }
        foreach ($parts as $item) {
            $result += $item->getCostByPage();
        }

        return $result;
    }

    /**
     * Devuelvew el costo por página del drum de un color específico
     *
     * @param Toner $toner
     *
     * @return float|int ;
     */
    private function getDrumCostByPage($toner) {
        $drums = $this->getDrums();
        if (!$drums || !$toner) {

            return 0;
        }
        foreach ($drums as $item) {

            if (strtoupper($item->getColor()
                    ->getDescription()) === strtoupper($toner->getColor()
                    ->getDescription())) {

                return $item->getCostByPage();
            }
        }

        return 0;
    }

    /**
     * Devuelve el costo por pagina de color
     *
     * @return float|int
     * @throws \Exception
     */
    public function getColorPageCost() {
        $toners = $this->getToners();
        if (!$this->isColor() || !$toners) {

            return 0;
        }
        $result = 0;
        foreach ($toners as $toner) {
            $result += $this->getTonerPriceByPage($toner);
        }

        return round($result * (1 + $this->getPageProfit() / 100), 5);
    }

    /**
     * Devuelve el costo por pagina de color
     *
     * @return float|int
     * @throws \Exception
     */
    public function getAdminColorPageCost() {
        $toners = $this->getToners();
        if (!$this->isColor() || !$toners) {

            return 0;
        }
        $result = 0;
        foreach ($toners as $toner) {
            $result += $this->getTonerPriceByPage($toner);
        }

        return round($result, 5);
    }

    /**
     * Devuelve el costo por pagina de Blanco y Negro
     *
     * @return float|int
     * @throws \Exception
     */
    public function getBlackPageCost() {
        $toners = $this->getToners();
        if (!$toners) {

            return 0;
        }
        foreach ($toners as $toner) {
            if (strtoupper($toner->getColorDescrition()) === strtoupper(TonerColors::BLACK)) {

                return round($this->getTonerPriceByPage($toner) * (1 + $this->getPageProfit() / 100), 5);
            }
        }

        return 0;

    }

    /**
     * Devuelve el costo por pagina de color
     *
     * @return float|int
     * @throws \Exception
     */
    public function getAdminBlackPageCost() {
        $toners = $this->getToners();
        if (!$toners) {

            return 0;
        }
        foreach ($toners as $toner) {
            if (strtoupper($toner->getColorDescrition()) === strtoupper(TonerColors::BLACK)) {

                return round($this->getTonerPriceByPage($toner), 5);
            }
        }

        return 0;

    }

    /**
     * Devuelve el costo por pagina de la máquina
     *
     * @return float|int
     * @throws \Exception
     */
    public function getCostByPage() {
        if (!$this->isColor()) {

            return $this->getBlackPageCost();
        }

        return $this->getColorPageCost();
    }

    /******************************** Cálculo del coste fijo *************************************/

    /**
     * Devuelve el precio fijo de la máquina sin el profit del periodo
     *
     * @return float
     */
    public function getMachineFixedPrice() {

        return round($this->getMachineFixedCost() * (1 + $this->getProfit() / 100), 5);
    }

    /**
     * Devuelve el precio fijo de la máquina sin el profit de la máquina
     *
     * @return float
     */
    public function getMachineFixedCost() {
        $cost = $this->getPrice() + $this->getMonitorizationPrice() + $this->getInstalationPrice();

        if ($this->getCarePack()) {
            $cost += $this->getCarePack()->getPrice();
        }

        return $cost;
    }

    /**
     * @return \AppBundle\Entity\SalesOrder[]|ArrayCollection
     */
    public function getSalesOrders() {
        return $this->salesOrders;
    }

    /**
     * @param \AppBundle\Entity\SalesOrder[]|ArrayCollection $salesOrders
     */
    public function setSalesOrders(array $salesOrders) {
        $this->salesOrders = $salesOrders;
    }

    /******************************** Otros datos *************************************/

    /**
     * @return Toner|null
     * @throws \Exception
     */
    public function getTonerBlack() {
        return $this->getToner([TonerColors::BLACK]);
    }

    /**
     * @return Toner|null
     * @throws \Exception
     */
    public function getTonerColor() {
        return $this->getToner(TonerColors::ONLY_COLORS_ARRAY);
    }

    /**
     * @param array $colors
     *
     * @return \AppBundle\Entity\Toner|null
     * @throws \Exception
     * @internal param $color
     */
    private function getToner(array $colors)
    {
         foreach ($this->getToners() as $toner) {
            if (in_array($toner->getColorDescrition(), $colors)) {

                return $toner;
            }
        }

        return null;
    }

    /**
     * @return float|int
     * @throws \Exception
     */
    public function getBlackTonerPrice()
    {
        $toner = $this->getTonerBlack();
        if (!$toner) {

            return 0;
        }

        return round($this->getBlackPageCost() * $toner->getRecomendedVolume(), 5);
    }

    /**
     * @return float|int
     * @throws \Exception
     */
    public function getColorTonerPrice()
    {
        $toner = $this->getTonerColor();
        if (!$toner) {

            return 0;
        }

        return round( ($this->getColorPageCost() - $this->getBlackPageCost()) / 3 * $this->getTonerColor()->getRecomendedVolume(), 5);
    }

    /**
     * @return string
     */
    public function getChromaTypeDescription() {
        if (!$this->chromaType) {

            return '';
        }

        return $this->chromaType->getDescription();
    }

    /**
     * @return boolean
     */
    function isDeletable() {
        return $this->salesOrders->isEmpty();
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
     * @return File
     */
    public function getSheetFile() {
        return $this->sheetFile;
    }

    /**
     * @param File|UploadedFile $sheetFile
     */
    public function setSheetFile(File $sheetFile = NULL) {
        $this->sheetFile = $sheetFile;
        if ($sheetFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $date = new DateTime();
            $this->aditionalMainInfo  = $date->getTimestamp();
        }
    }
}