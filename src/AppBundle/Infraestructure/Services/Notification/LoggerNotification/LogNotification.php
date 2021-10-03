<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 08/03/2018
 * Time: 2:44
 */

namespace AppBundle\Infraestructure\Services\Notification\LoggerNotification;


use AppBundle\Application\Service\Notification\Notification;

interface LogNotification extends Notification {
    public function channel();
}