<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CarePackProfitRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class CarePackProfitRepository extends EntityRepository
{

    /**
     * @param $duration
     *
     * @return int
     */
    public function getProfitByDuration($duration)
    {
        $carePackProfit = $this->getEntityManager()->getRepository('AppBundle:CarePackProfit')->findOneBy(['duration' => $duration]);

        if (!$carePackProfit) {
            return 0;
        }

        return $carePackProfit->getProfit();
    }
}
