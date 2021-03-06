<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\SalesOrder;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class SalesOrderRepository extends EntityRepository
{
    /**
     * @param SalesOrder $salesOrder
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(SalesOrder $salesOrder)
    {
        $this->getEntityManager()->persist($salesOrder);
        $this->getEntityManager()->flush();
    }
}
