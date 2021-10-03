<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 21/08/2017
 * Time: 16:08
 */

namespace AppBundle\Event;

final class TransactionSuccessEventes
{
    /**
     * Este evento se dispara provocando el envio de un email
     *
     * Los listener de este evento deben esperar una instancia de:
     *
     * Symfony\Component\EventDispatcher\GenericEvent
     *
     * Si alguno de los listener cancela la propagación del
     * evento ($event->stopPropagation()), la aprobación
     * no se realiza.
     */
    const TRANSACTION_SUCCESS_EVENT = 'docutea.transaction.success';

}