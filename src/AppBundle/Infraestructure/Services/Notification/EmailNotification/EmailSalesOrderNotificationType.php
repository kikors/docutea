<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 08/03/2018
 * Time: 3:08
 */

namespace AppBundle\Infraestructure\Services\Notification\EmailNotification;


use AppBundle\Application\Service\Notification\NotificationType;

class EmailSalesOrderNotificationType implements NotificationType {

    private $type;

    /**
     * EmailSalesOrderNotificationType constructor.
     *
     * @param string $type
     */
    public function __construct(string $type) {
        $this->type = $type;
    }

    public function value() {
        return $this->type;
    }
}