<?php

namespace AppBundle\Controller;

use AppBundle\Application\Service\Dto\CartProductBaseDTO;
use AppBundle\Application\Service\Dto\StoreOrderDTO;
use AppBundle\Application\Service\Exception\CantBuildCartProductException;
use AppBundle\Form\StoreOrderDTOType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends Controller
{
    /**
     * @Route("/tienda", name="home_store")
     * @return Response
     * @throws Exception
     */
    public function homeStoreAction(): Response
    {
        $appService = $this->get('docutea.application.listar_productos');
        $appService->execute();

        return $this->render('store/home_store.html.twig', [
            'products' => $appService->getTransform()->read(),
        ]);
    }

    /**
     * @Route("/tienda/product-details/{id}", name="product_details")
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function producDetailAction(int $id): Response
    {
        $appService = $this->get('docutea.application.detalles_producto');
        $appService->execute($id);
        return $this->render('store/product_details.html.twig', [
            'product' => $appService->getTransform()->read(),
        ]);
    }

    /**
     * @Route("/tienda/cart/add/{id}/{qtty}", name="store_cart_add")
     * @param int $id
     * @param int $qtty
     * @return Response
     * @throws CantBuildCartProductException
     */
    public function producAddCartAction(int $id, int $qtty): Response
    {
        $appService = $this->get('docutea.application.add_product_to_cart');
        $appService->execute(new CartProductBaseDTO($id, $qtty));
        $cart = $appService->getTransform()->read();

        $response = new Response($cart);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/tienda/cart/update/{id}/{qtty}", name="store_cart_update")
     * @param int $id
     * @param int $qtty
     * @return Response
     * @throws CantBuildCartProductException
     */
    public function producUpdateCartAction(int $id, int $qtty): Response
    {
        $appService = $this->get('docutea.application.update_product_to_cart');
        $appService->execute(new CartProductBaseDTO($id, $qtty));
        $cart = $appService->getTransform()->read();

        $response = new Response($cart);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/store/cart/delete/{id}", name="store_cart_delete")
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function producDeleteCartAction(int $id): Response
    {
        $appService = $this->get('docutea.application.delete_product_to_cart');
        $appService->execute($id);
        $cart = $appService->getTransform()->read();

        $response = new Response($cart);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/tienda/cart/", name="store_cart_details")
     * @return Response
     * @throws Exception
     */
    public function cartDetailsAction(): Response
    {
        $appService = $this->get('docutea.application.view_cart');
        $appService->execute();
        $cart = $appService->getTransform()->read();

        return $this->render('store/cart_details.html.twig', [
            'cart' => $cart
        ]);
    }

    /**
     * @Route("/tienda/confirmar-pedido/", name="confirm_order")
     * @return Response
     * @throws Exception
     */
    public function confirmOrderAction(): Response
    {
        $appService = $this->get('docutea.application.view_cart');
        $appService->execute();
        $cart = $appService->getTransform()->read();

        if (0 >= $cart->getTotalPrice()) {
            return $this->cartDetailsAction();
        }
        return $this->render('store/confirm_order_info.html.twig', [
            'cart' => $cart
        ]);
    }

    /**
     * @Route("/tienda/datos-usuario/", name="store_user_data")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function getUserDataAction(Request $request): Response
    {
        $appValidationService = $this->get('docutea.infraestructure_services.shopping_cart_has_amount');
        if (!$appValidationService->hasAmount()) {
            return $this->cartDetailsAction();
        }
        $storeOrderDTO = new StoreOrderDTO();
        $form = $this->createForm(StoreOrderDTOType::class, $storeOrderDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->get('docutea.application.create_store_order')->execute($data);
            return $this->redirectToRoute('tpv_make_payment');
        }

        return $this->render('store/shopping_cart_user_data_form.html.twig', ['form' => $form->createView()]);
    }
}