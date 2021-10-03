<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 08/03/2018
 * Time: 2:44
 */

namespace AppBundle\Infraestructure\Services\Notification\EmailNotification;


use AppBundle\Application\Service\Notification\Notification;

interface EmailNotification extends Notification {

    /**
     * @return mixed
     */
    public function email(): string;

    /**
     * @return mixed
     */
    public function attach(): array;
}