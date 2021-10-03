<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/03/2018
 * Time: 3:04
 */

namespace AppBundle\Infraestructure\Services\Notification\EmailNotification;

use AppBundle\Application\Service\Notification\NotificationSubjectNotExist;
use AppBundle\Application\Service\Notification\NotificationSubjectNotExistOrIsIncorrect;
use AppBundle\Domain\Model\StoreOrder;
use AppBundle\Entity\SalesOrder;

/**
 * Class EmailStoreOrderNotificationContent
 * @package AppBundle\Infraestructure\Services\Notification\EmailNotification
 */
class EmailStoreOrderNotificationContent implements EmailNotificationContent {

    /**
     * @var SalesOrder
     */
    private $subject;

    /**
     * @var
     */
    private $email;

    /**
     * @var
     */
    private $attach;

    /**
     * SalesOrderNotificationContent constructor.
     *
     * @param StoreOrder $subject
     * @param $email
     * @param array $attach
     */
    public function __construct(StoreOrder $subject, $email, array $attach = []) {
        $this->subject = $subject;
        $this->email = $email;
        $this->attach = $attach;
    }

    /**
     * @return mixed
     * @throws NotificationSubjectNotExist
     */
    public function value() {
        if (!$this->subject) {

            throw new NotificationSubjectNotExist('El contrato que se notificará no puede ser nulo');
        }

        return $this->subject;
    }

    /**
     * @return string
     * @throws NotificationSubjectNotExistOrIsIncorrect
     */
    public function email() {
        $email = $this->email;
        if (!$email) {

            throw new NotificationSubjectNotExistOrIsIncorrect('EL contrato no tiene cliente o el cliente no tiene email');
        }

        return $this->email;
    }

    /**
     * @return array
     */
    public function attach() {
        if (!count($this->attach)) {

            return [];
        }

        return $this->attach;
    }
}