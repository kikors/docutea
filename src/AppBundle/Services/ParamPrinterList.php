<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 07/08/2017
 * Time: 14:25
 */

namespace AppBundle\Services;


use AppBundle\Entity\ChromaType;
use AppBundle\Entity\FormatType;
use AppBundle\Entity\FunctionalityType;
use AppBundle\Entity\Machine;
use AppBundle\Entity\Maker;
use Doctrine\ORM\EntityManager;

/**
 * Class ParamPrinterList
 * @package AppBundle\Services
 */
class ParamPrinterList
{
    /**
     * @var EntityManager
     */
    private $em;


    /**
     * ParamPrinterList constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Machine|null $machine
     * @param FormatType|null $format
     * @param ChromaType|null $chroma
     * @param FunctionalityType|null $functionality
     * @param Maker|null $maker
     * @param null $pages
     * @return array
     */
    public function getParamPrinterList(Machine $machine = null, FormatType $format = null, ChromaType $chroma = null, FunctionalityType $functionality = null, Maker $maker = null, $pages = null)
    {
        if ($machine) {
            return $this->em->getRepository('AppBundle:Machine')->getParamsPrintersList(
                $machine->getFormat(), $machine->getChromaType(),
                $machine->getFunctionality(), $machine->getPageRange()
            );
        }

        if ($maker) {
            return $this->em->getRepository('AppBundle:Machine')->getParamsPrintersList($format, $chroma, $functionality, null, $maker);
        }
        if ($pages) {
            return $this->em->getRepository('AppBundle:Machine')->getParamsPrintersList(
                $format, $chroma, $functionality,
                $this->em->getRepository('AppBundle:PageRange')->getPageRangeByPages($pages)
            );
        }

        return $this->getDefaultMachineList();
    }

    /**
     * @return array
     */
    private function getDefaultMachineList()
    {
        return $this->em->getRepository('AppBundle:Machine')->getParamsPrintersList(
            DefaultValues::getDefault($this->em->getRepository('AppBundle:FormatType')),
            DefaultValues::getDefault($this->em->getRepository('AppBundle:ChromaType')),
            DefaultValues::getDefault($this->em->getRepository('AppBundle:FunctionalityType')),
            DefaultValues::getDefault($this->em->getRepository('AppBundle:PageRange'))
        );
    }
}