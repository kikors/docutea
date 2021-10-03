<?php


namespace AppBundle\Application\Service;

use AppBundle\Application\Service\Dto\StoreOrderDTO;
use AppBundle\Application\Service\Factory\StoreOrderFactory;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;
use AppBundle\Domain\Model\StoreOrderRepositoryInterface;
use Exception;

class CreateStoreOrder implements ApplicationServiceInterface
{
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $cartRepository;
    /**
     * @var StoreOrderRepositoryInterface
     */
    private $storeOrderRepository;
    /**
     * @var StoreOrderFactory
     */
    private $factory;

    /**
     * CreateStoreOrder constructor.
     * @param ShoppingCartRepositoryInterface $cartRepository
     * @param StoreOrderRepositoryInterface $storeOrderRepository
     * @param StoreOrderFactory $factory
     */
    public function __construct(
        ShoppingCartRepositoryInterface $cartRepository,
        StoreOrderRepositoryInterface $storeOrderRepository,
        StoreOrderFactory $factory
    )
    {
        $this->cartRepository = $cartRepository;
        $this->factory = $factory;
        $this->storeOrderRepository = $storeOrderRepository;
    }

    /**
     * @param StoreOrderDTO|null $storeOrderDto
     * @throws Exception
     */
    public function execute($storeOrderDto = null): void
    {
        $cart = $this->cartRepository->getCart();
        $storeOrderDto->setAmount($cart->total());
        $storeOrderDto->setDescrition($cart->getMerchantData());

        $storeOrder = $this->factory->createFromDto($storeOrderDto);
        $this->storeOrderRepository->save($storeOrder);

        $cart->setId($storeOrder->getTransactId());
        $this->cartRepository->saveCart($cart);
    }
}