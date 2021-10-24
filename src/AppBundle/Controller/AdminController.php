<?php
/**
 * Created by PhpStorm.
 * User: javier.mares
 * Date: 12/06/2017
 * Time: 10:42
 */

namespace AppBundle\Controller;

use AppBundle\Entity\SalesOrder;
use AppBundle\Entity\SentConsumable;
use AppBundle\Event\ConciliatedEvent;
use AppBundle\StaticsClass\SalesOrderStates;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use FOS\UserBundle\Model\UserInterface;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class AdminController
 *
 * @package AppBundle\Controller
 */
class AdminController extends BaseAdminController
{

    /**
     * @return UserInterface|mixed
     */
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    /**
     * @param $user
     */
    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, FALSE);
        $this->get('fos_user.user_manager')->updatePassword($user);
    }

    /**
     * @param $user
     */
    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, FALSE);
    }

    /**
     * @return RedirectResponse
     * @throws Exception
     */
    public function conciliationAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $salesOrder = $this->getDoctrine()
            ->getRepository('AppBundle:SalesOrder')
            ->find($request->query->get('id'));

        if ($salesOrder->getState() === SalesOrderStates::CLOSE) {

            return $this->redirectToRoute('easyadmin', [
                'action' => 'list',
                'entity' => $request->query->get('entity'),
            ]);
        }
        $this->get('event_dispatcher')->dispatch(
            'app_bundle.sales_order.reconciliated',
            new ConciliatedEvent($salesOrder)
        );

        $newContract = $this->get('app.services.sales_order_manager')->replicate($salesOrder);
        $this->getDoctrine()->getRepository('AppBundle:SalesOrder')->save($newContract);
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $newContract->getId(),
            'entity' => $request->query->get('entity'),
        ));

    }

    /**
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function consolidationAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $this->get('app_bundle.sales_order.consolidation')->onCheckIn();

        return $this->redirectToRoute('easyadmin', [
            'action' => 'list',
            'entity' => $request->query->get('entity'),
        ]);

    }

    /**
     * @return SalesOrder
     */
    protected function createNewSalesorderEntity()
    {
        return $this->get('app.services.sales_order_manager')->createBlanc();
    }

    /**
     *
     * @return RedirectResponse
     */
    public function terminateAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $salesOrder = $this->getDoctrine()
            ->getRepository('AppBundle:SalesOrder')
            ->find($request->query->get('id'));

        (new EventDispatcher())->dispatch(
            'app_bundle.sales_order.terminate',
            new ConciliatedEvent($salesOrder)
        );

        return $this->redirectToRoute('easyadmin', [
            'action' => 'list',
            'entity' => $request->query->get('entity'),
        ]);
    }

    /**
     * @param SalesOrder $salesOrder
     */
    public function updateSalesOrderEntity($salesOrder)
    {
        $em = $this->getDoctrine()->getManager();
        $parent = $this->getDoctrine()
            ->getRepository('AppBundle:SalesOrder')
            ->findOneBy(['contractNumber' => $salesOrder->getParent()]);
        if ((null !== $salesOrder->getAcceptedAt()) && ($salesOrder->getState() !== SalesOrderStates::CLOSE)) {
            if ($parent) {
                $parent->setState(SalesOrderStates::CLOSE);
                $em->persist($parent);

                return;
            }
            $salesOrder->getCostumer()->setEnabled(true);
            $salesOrder->setState(SalesOrderStates::ACCEPTED);
            $this->getDoctrine()->getManagerForClass('AppBundle:SalesOrder')->flush();
        }
    }

    /**
     * @param $entity
     * @throws ORMException
     */
    public function persistEntity($entity)
    {
        $this->updateSalesOrder($entity);
//        parent::persistEntity($entity);
    }

    /**
     * @param $entity
     * @throws ORMException
     */
    private function updateSalesOrder($entity)
    {
        if ($entity instanceof SentConsumable) {
            $em = $this->get('doctrine.orm.entity_manager');
            $salesOrder = $entity->getSalesOrder();
            if ($salesOrder->getState() !== SalesOrderStates::ACCEPTED) {
                $salesOrder->setState(SalesOrderStates::ACCEPTED);
                $em->persist($salesOrder);
                $em->flush();
            }
        }
    }
}