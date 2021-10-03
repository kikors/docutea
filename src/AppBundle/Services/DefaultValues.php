<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 06/08/2017
 * Time: 21:18
 */

namespace AppBundle\Services;


use AppBundle\Entity\ChromaType;
use AppBundle\Entity\ContractTime;
use AppBundle\Entity\FormatType;
use AppBundle\Entity\FunctionalityType;
use AppBundle\Entity\Maker;
use AppBundle\Entity\PageRange;
use AppBundle\Entity\Technology;
use Doctrine\ORM\EntityRepository;

/**
 * Class DefaultValues
 * @package AppBundle\Services
 */
class DefaultValues
{

    /**
     * @param EntityRepository $em
     * @return null|object|Technology|FormatType|ChromaType|FunctionalityType|PageRange|Maker|ContractTime
     * @throws \Exception
     */
    public static function getDefault(EntityRepository $em) {
        $result = $em->findOneBy(['default' => true]);
        if(!$result) {

            throw new \Exception('No se ha definido un valor por defecto para la entidad '.$em->getClassName());
        }

        return $result;
    }

}