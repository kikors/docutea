<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/03/2018
 * Time: 2:51
 */

namespace AppBundle\Application\Service\Notification;


interface Notifier {

    public function notify(Notification $subject, NotificationType $action);
}