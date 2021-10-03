<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Machine;
use AppBundle\Entity\User;
use AppBundle\Event\NewSalesOrderEvent;
use AppBundle\StaticsClass\SalesOrderEvents;
use AppBundle\StaticsClass\Serials;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContractController
 *
 * @package AppBundle\Controller
 *
 * @Route("contratar-servicio")
 */
class ContractController extends Controller {

    /**
     * @Route("/crear-oferta/{idMachine}/{colorPercent}/{pages}/{duration}", name="contract_new")
     * @param Machine $idMachine
     * @param $colorPercent
     * @param $pages
     * @param $duration
     * @param Request $request
     *
     * @return Response
     * @internal param $idMachine
     */
    public function createOfertAction(Machine $idMachine, $colorPercent, $pages, $duration, Request $request) {
        $form = $this->createAddressForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('event_dispatcher')->dispatch(
                SalesOrderEvents::CREATE_OFERT,
                new NewSalesOrderEvent($idMachine, $duration, $pages, $colorPercent, $this->getUser(), $form->getData())
            );
            return $this->redirectToRoute('configurer');
        }

        return $this->render('configurer/address.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);

    }

    /**
     * @Route("/crear-registro-oferta/{idUser}/{idMachine}/{colorPercent}/{pages}/{duration}", name="contract_new_register")
     * @param User $idUser
     * @param Machine $idMachine
     * @param $colorPercent
     * @param $pages
     * @param $duration
     * @param Request $request
     *
     * @return Response
     * @internal param $idMachine
     */
    public function createOfertRegisterAction(User $idUser, Machine $idMachine, $colorPercent, $pages, $duration, Request $request) {
        if (!$idUser) {

            return $this->redirectToRoute('configurer');
        }
        $form = $this->createAddressForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('event_dispatcher')->dispatch(
                SalesOrderEvents::CREATE_OFERT,
                new NewSalesOrderEvent($idMachine, $duration, $pages, $colorPercent, $idUser, $form->getData())
            );
            return $this->redirectToRoute('configurer');
        }

        return $this->render('configurer/address.html.twig', [
            'form' => $form->createView(),
            'user' => $idUser,
        ]);

    }

    /**
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createAddressForm() {
        return $this->createFormBuilder()
            ->add('direccion', TextType::class, [
                'label' => 'Dirección:',
            ])
            ->add('poblacion', TextType::class, [
                'label' => 'Población:',
            ])
            ->add('provincia', ChoiceType::class, [
                'label' => 'Provicia:',
                'choices' => Serials::PROVINCES,
            ])
            ->add('cp', TextType::class, [
                'label' => 'C.P.:',
            ])
            ->add('contacto', TextType::class, [
                'label' => 'Contacto:',
            ])
            ->add('telefono', TextType::class, [
                'label' => 'Telefono:',
            ])
            ->add('aceptar', SubmitType::class, [
                'label' => 'Enviar',
            ])
            ->getForm();
    }
}
