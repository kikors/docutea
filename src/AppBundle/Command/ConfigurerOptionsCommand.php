<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 05/08/2017
 * Time: 22:37
 */

namespace AppBundle\Command;


use AppBundle\Entity\ChromaType;
use AppBundle\Entity\FormatType;
use AppBundle\Entity\FunctionalityType;
use AppBundle\Entity\Maker;
use AppBundle\Entity\PageRange;
use AppBundle\Entity\Technology;

class ConfigurerOptionsCommand
{

    private $technology;
    private $format;
    private $chroma;
    private $functionality;
    private $range;
    private $colorPercent;
    private $maker;

    /**
     * ConfigurerCommand constructor.
     * @param Technology $technology
     * @param FormatType $format
     * @param ChromaType $chroma
     * @param FunctionalityType $functionality
     * @param PageRange $range
     * @param $colorPercent
     * @param Maker|null $maker
     */
    public function __construct(Technology $technology, FormatType $format, ChromaType $chroma, FunctionalityType $functionality, PageRange $range, $colorPercent, Maker $maker = null)
    {
        $this->technology = $technology;
        $this->format = $format;
        $this->functionality = $functionality;
        $this->chroma = $chroma;
        $this->colorPercent = $colorPercent;
        $this->range = $range;
        $this->maker = $maker;
    }

    /**
     * @return Technology
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * @return FormatType
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return ChromaType
     */
    public function getChroma()
    {
        return $this->chroma;
    }

    /**
     * @return FunctionalityType
     */
    public function getFunctionality()
    {
        return $this->functionality;
    }

    /**
     * @return PageRange
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @return mixed
     */
    public function getColorPercent()
    {
        return $this->colorPercent;
    }

    /**
     * @return Maker|null
     */
    public function getMaker()
    {
        return $this->maker;
    }
}