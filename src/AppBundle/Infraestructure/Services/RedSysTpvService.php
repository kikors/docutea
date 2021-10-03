<?php


namespace AppBundle\Infraestructure\Services;


use AppBundle\Application\Service\ShoppingCartCheckCartInterface;
use AppBundle\Application\Service\TpvServiceInterface;
use AppBundle\Domain\Model\ShoppingCartRepositoryInterface;
use Exception;
use Redsys\Tpv\Tpv;

class RedSysTpvService implements TpvServiceInterface
{
    const TRANSACTION_TYPE = '0';
    /**
     * @var Tpv
     */
    private $tpvClient;
    /**
     * @var string
     */
    private $urlMerchant;
    /**
     * @var string|null
     */
    private $urlOk;
    /**
     * @var string|null
     */
    private $urkKo;
    /**
     * @var ShoppingCartRepositoryInterface
     */
    private $repository;
    /**
     * @var ShoppingCartCheckCartInterface
     */
    private $checkCart;

    /**
     * RedSysTpvService constructor.
     * @param ShoppingCartRepositoryInterface $repository
     * @param ShoppingCartCheckCartInterface $checkCart
     * @param array $config
     * @param string $urlMerchant
     * @param string|null $urlOk
     * @param string|null $urkKo
     */
    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        ShoppingCartCheckCartInterface $checkCart,
        array $config,
        string $urlMerchant,
        ?string $urlOk,
        ?string $urkKo
    )
    {
        $this->tpvClient = new Tpv($config);
        $this->urlMerchant = $urlMerchant;
        $this->urlOk = $urlOk;
        $this->urkKo = $urkKo;
        $this->repository = $repository;
        $this->checkCart = $checkCart;
    }

    /**
     * @throws Exception
     */
    public function makePayment(): void
    {
        $shoppingCart = $this->repository->getCart();
        if (0 === $shoppingCart->total()) {
            return;
        }
        if (!$this->checkCart->check($shoppingCart)) {
            throw new Exception('Erro de integridad en el carro de compras');
        }
        $this->tpvClient->setFormHiddens([
            'TransactionType' => self::TRANSACTION_TYPE,
            'MerchantData' => $shoppingCart->getMerchantData(),
            'Order' => $shoppingCart->id(),
            'Amount' => strval($shoppingCart->total()),
            'UrlOK' => $this->urlOk,
            'UrlKO' => $this->urkKo,
            'MerchantURL' => $this->urlMerchant
        ]);

        echo '<form action="'.$this->tpvClient->getPath('/realizarPago').'" method="post">'.$this->tpvClient->getFormHiddens().'</form>';

        die('<script>document.forms[0].submit();</script>');
    }

    public function checkPayment(): void
    {
        // TODO: Implement checkPayment() method.
    }
}