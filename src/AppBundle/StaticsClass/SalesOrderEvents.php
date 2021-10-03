<?php
/**
 * Created by PhpStorm.
 * User: VassDigital
 * Date: 14/11/2016
 * Time: 12:12
 */

namespace AppBundle\StaticsClass;

final class SalesOrderEvents
{
    /**
     * Este evento se ejecuta cuando se crea la oferta para la orden de ventas
     * Los listener de este evento deben esperar una instancia de:
     *
     * Symfony\Component\EventDispatcher\GenericEvent
     *
     * Si alguno de los listener cancela la propagación del
     * evento ($event->stopPropagation()), no se crea la sales order
     */
    const CREATE_OFERT = 'app_bundle.sales_order.create_ofert';
}