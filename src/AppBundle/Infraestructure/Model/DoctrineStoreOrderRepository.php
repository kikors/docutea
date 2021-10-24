<?php


namespace AppBundle\Infraestructure\Model;


use AppBundle\Domain\Model\StoreOrder;
use AppBundle\Domain\Model\StoreOrderServiceInterface;
use AppBundle\Domain\Model\StoreOrderRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DoctrineStoreOrderRepository implements StoreOrderRepositoryInterface
{
    /**
     * @var StoreOrderServiceInterface
     */
    private $translator;
    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * DoctrineStoreOrderRepository constructor.
     * @param EntityManager $em
     * @param StoreOrderServiceInterface $translator
     */
    public function __construct(EntityManager $em, StoreOrderServiceInterface $translator)
    {
        $this->translator = $translator;
        $this->repository = $em->getRepository('AppBundle:StoreOrderForPersistence');
    }


    /**
     * @param StoreOrder $order
     */
    public function save(StoreOrder $order): void
    {
        $storeOrderForPersistence = $this->translator->unTranslate($order);
        $this->repository->save($storeOrderForPersistence);
    }

    /**
     * @param string $id
     * @return StoreOrder|null
     */
    public function ofId(string $id): ?StoreOrder
    {
        $storeOrderForPersistence = $this->repository->ofId($id);
        if (!$storeOrderForPersistence) {
            return null;
        }

        return $this->translator->translate($storeOrderForPersistence);
    }

    public function ofTransactId(string $id): ?StoreOrder
    {
        $storeOrderForPersistence = $this->repository->ofTransactId($id);
        if (!$storeOrderForPersistence) {
            return null;
        }

        return $this->translator->translate($storeOrderForPersistence);
    }
}