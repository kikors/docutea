<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/03/2018
 * Time: 15:12
 */

namespace AppBundle\Infraestructure\Services\Notification\EmailNotification;


final class NotifierActions {

    const NEW_SALES_ORDER_CREATE_USER_SUBJECT = 'Bienvenido a Docutea';

    const NOTIFY_CREATE_SALESORDER_ADMIN = 'Se ha creado un nuevo contrato';
    
    const NOTIFY_USER_NEW_SALES_ORDER_CREATED = 'Crear de usuario nuevo';

    const NOTIFY_STORE_ORDER_CREATED = 'DOCUTEA: Usted ha realizado satisfactoriamente su compra';

    const NOTIFY_STORE_ORDER_FAILED = 'DOCUTEA: Lo sentimos, su compra no se ha podido realizar';
}