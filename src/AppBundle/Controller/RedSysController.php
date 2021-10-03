<?php


namespace AppBundle\Controller;


use AppBundle\Application\DataTransformer\ShoppinCartDTODataTransformer;
use AppBundle\Application\Service\Dto\BaseStoreOrderDTO;
use AppBundle\Domain\Model\ShoppingCart;
use AppBundle\Domain\Model\StoreOrder;
use AppBundle\Event\ConciliatedEvent;
use AppBundle\Event\SendMailEvent;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailSalesOrderNotificationContent;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailSalesOrderNotificationType;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\NotifierActions;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RedSysController
 * @package AppBundle\Controller
 *
 *@Route(path="/tpv", name="tpv")
 */
class RedSysController extends Controller
{
    /**
     * @var array
     */
    private $config;

    /**
     * @Route(path="/make-payment", name="tpv_make_payment")
     * @throws Exception
     */
    public function payCheckAction(): RedirectResponse
    {
        $this->get('docutea.infraestructure_services.red_sys_tpv_service')->makePayment();

        return $this->redirectToRoute('store_cart_details');
    }

    /**
     * @Route(path="/success", name="tpv_success")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function successAction(Request $request): Response
    {
        $appService = $this->get('docutea.application.success_store_order');
        $appService->execute($request->query->get('Ds_MerchantParameters'));
        $cart = $appService->getTransform()->read();

        $this->get('docutea.infrastructure.inmemory_shopping_cart_repository')->saveCart(new ShoppingCart());

        return $this->render('store/checkout_success.html.twig', [
            'resumen' => $cart
        ]);
    }

    /**
     * @Route(path="/denied", name="tpv_denied")
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function deniedAction(Request $request): RedirectResponse
    {
        $this->get('docutea.application.denied_store_order')->execute($request->query->get('Ds_MerchantParameters'));

        return $this->redirectToRoute('store_cart_details');
    }
}