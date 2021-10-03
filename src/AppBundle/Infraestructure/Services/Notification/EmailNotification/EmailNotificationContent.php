<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 08/03/2018
 * Time: 2:44
 */

namespace AppBundle\Infraestructure\Services\Notification\EmailNotification;


use AppBundle\Application\Service\Notification\NotificationContent;

interface EmailNotificationContent extends NotificationContent {
    public function email();
    public function attach();
}