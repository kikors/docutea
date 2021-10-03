<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/03/2018
 * Time: 3:04
 */

namespace AppBundle\Infraestructure\Services\Notification\EmailNotification;

use AppBundle\Application\Service\Dto\ShoppingCartDTO;
use AppBundle\Application\Service\Notification\NotificationSubjectNotExist;
use AppBundle\Application\Service\Notification\NotificationSubjectNotExistOrIsIncorrect;
use AppBundle\Entity\SalesOrder;

/**
 * Class EmailStoreOrderNotificationContent
 * @package AppBundle\Infraestructure\Services\Notification\EmailNotification
 */
class EmailStoreOrderNotification implements EmailNotification {

    /**
     * @var SalesOrder
     */
    private $content;

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
     * @param ShoppingCartDTO $content
     * @param string $email
     * @param array $attach
     */
    public function __construct(ShoppingCartDTO $content, string $email, array $attach = []) {
        $this->content = $content;
        $this->email = $email;
        $this->attach = $attach;
    }

    /**
     * @return ShoppingCartDTO
     * @throws NotificationSubjectNotExist
     */
    public function value() {
        if (!$this->content) {

            throw new NotificationSubjectNotExist('El contrato que se notificará no puede ser nulo');
        }
        return $this->content;
    }

    /**
     * @return string
     * @throws NotificationSubjectNotExistOrIsIncorrect
     */
    public function email(): string {
        $email = $this->email;
        if (!$email) {

            throw new NotificationSubjectNotExistOrIsIncorrect('EL contrato no tiene cliente o el cliente no tiene email');
        }

        return $this->email;
    }

    /**
     * @return array
     */
    public function attach(): array {

        return $this->attach;
    }
}