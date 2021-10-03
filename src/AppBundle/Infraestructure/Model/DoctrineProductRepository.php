<?php


namespace AppBundle\Infraestructure\Model;


use AppBundle\Domain\Model\Product;
use AppBundle\Domain\Model\ProductRepositoryInterface;
use AppBundle\Domain\Model\ProductServiceInterface;
use AppBundle\Entity\Repository\ProductForPersistenceRepository;
use Doctrine\ORM\EntityManager;
use Exception;

class DoctrineProductRepository implements ProductRepositoryInterface
{
    /**
     * @var ProductForPersistenceRepository
     */
    private $productForPersistenceRepository;

    /**
     * @var ProductTranslator
     */
    private $translator;

    /**
     * DoctrineProductRepository constructor.
     * @param EntityManager $em
     * @param ProductServiceInterface $translator
     */
    public function __construct(EntityManager $em, ProductServiceInterface $translator)
    {
        $this->productForPersistenceRepository = $em->getRepository('AppBundle:ProductForPersistence');
        $this->translator = $translator;
    }

    /**
     * @return array|null|Product[]
     * @throws Exception
     */
    public function all(): array
    {
        $productArray = [];
        $productsForPersistence = $this->productForPersistenceRepository->all();

        if (!$productsForPersistence) {

            return $productArray;
        }
        foreach ($productsForPersistence as $productForPersistence) {

            $productArray[] = $this->translator->translate($productForPersistence);
        }

        return $productArray;
    }

    /**
     * @return array|null|Product[]
     * @throws Exception
     */
    public function allEnabled(): array
    {
        $productArray = [];
        $productsForPersistence = $this->productForPersistenceRepository->all();

        if (!$productsForPersistence) {

            return $productArray;
        }
        foreach ($productsForPersistence as $productForPersistence) {
            if ($productForPersistence->isEnabled()) {
                $productArray[] = $this->translator->translate($productForPersistence);
            }
        }

        return $productArray;
    }

    /**
     * @param int $id
     * @return Product|null
     * @throws Exception
     */
    public function ofId(int $id): ?Product
    {
        $productForPersistence = $this->productForPersistenceRepository->ofId($id);
        if (!$productForPersistence) {
            return null;
        }

        return $this->translator->translate($productForPersistence);
    }
}