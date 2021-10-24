<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 21/08/2017
 * Time: 16:08
 */

namespace AppBundle\Event;

final class SalesOrderEvents
{
    /**
     * Este evento se ejecuta cuando se va a crear una orden de venta nueva a
     * partir de los datos del configurador
     * Los listener de este evento deben esperar una instancia de:
     *
     * Symfony\Component\EventDispatcher\GenericEvent
     *
     * Si alguno de los listener cancela la propagación del
     * evento ($event->stopPropagation()), la aprobación
     * no se realiza.
     */
    const CREATE_NEW = 'app_bundle.sales_order.create_ofert';

    /**
     * Este evento se ejecuta cuando se va a reconciliar una orden de venta
     * Los listener de este evento deben esperar una instancia de:
     *
     * Symfony\Component\EventDispatcher\GenericEvent
     *
     * Si alguno de los listener cancela la propagación del
     * evento ($event->stopPropagation()), la aprobación
     * no se realiza.
     */
    const RECONCILIATE = 'app_bundle.sales_order.reconciliated';
}