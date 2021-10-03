<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\ChromaType;
use AppBundle\Entity\FormatType;
use AppBundle\Entity\FunctionalityType;
use AppBundle\Entity\Machine;
use AppBundle\Entity\Maker;
use AppBundle\Entity\PageRange;
use Doctrine\ORM\EntityRepository;

/**
 * CarePackRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class MachineRepository extends EntityRepository
{
    /**
     * @param $id
     * @return null|object|Machine
     * @throws \Exception
     */
    public function findOrFail($id)
    {
        $result = $this->find($id);
        if (!$result) {

            throw new \Exception('No se encuentra la máquina en la BD, contacte con el adinistrador del sistema');
        }

        return $result;
    }

    /**
     * @param FormatType $format
     * @param ChromaType $chroma
     * @param FunctionalityType $functionality
     * @param PageRange $range
     * @param Maker|null $maker
     * @return array
     */
    public function getParamsPrintersList(FormatType $format, ChromaType $chroma, FunctionalityType $functionality, PageRange $range = null, Maker $maker = null)
    {
        $query = $this->createQueryBuilder('m')
            ->select('m')
            ->where('m.format = :format')
            ->andWhere('m.chromaType = :chroma')
            ->andWhere('m.functionality = :functionality')
            ->andWhere('m.enabled = :enabled')
            ->setParameter(':format', $format)
            ->setParameter(':chroma', $chroma)
            ->setParameter(':enabled', true)
            ->setParameter(':functionality', $functionality);
        if ($maker) {
            $query->andWhere('m.maker = :maker');
            $query->setParameter(':maker', $maker);
        }
        if ($range) {
            $query->andWhere('m.pageRange = :range');
            $query->setParameter(':range', $range);
        }

        return $query->getQuery()->getResult();
    }
}