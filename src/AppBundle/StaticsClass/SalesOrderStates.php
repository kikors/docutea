<?php
/**
 * Created by PhpStorm.
 * User: VassDigital
 * Date: 14/11/2016
 * Time: 12:12
 */

namespace AppBundle\StaticsClass;

final class SalesOrderStates
{
    const IN_PROCESS = 'En Proceso';

    const ACCEPTED = 'Aceptada';

    const DENIED = 'Denegada';

    const TO_INSTALL = 'Para Instalación';

    const READY = 'Completada';

    const CLOSE = 'Cerrada';
}