<?php


namespace AppBundle\Entity\Repository;

use AppBundle\Entity\StoreOrderForPersistence;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class StoreOrderForPersistenceRepository extends EntityRepository
{
    /**
     * @param string $id
     * @return StoreOrderForPersistence|null|mixed
     */
    public function ofId(string $id): ?StoreOrderForPersistence
    {
        return $this->find($id);
    }

    /**
     * @param string $id
     * @return StoreOrderForPersistence|null|mixed
     */
    public function ofTransactId(string $id): ?StoreOrderForPersistence
    {
        return $this->findOneBy(['transactId' => $id]);
    }

    /**
     * @param StoreOrderForPersistence $storeOrderForPersistence
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(StoreOrderForPersistence $storeOrderForPersistence): void
    {
        $existRecord = $this->ofId($storeOrderForPersistence->getId());
        if ($existRecord) {
            $this->_em->remove($existRecord);
            $this->_em->flush();
        }
        $this->_em->persist($storeOrderForPersistence);
        $this->_em->flush();
    }
}