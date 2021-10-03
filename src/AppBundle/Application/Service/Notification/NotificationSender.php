<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/03/2018
 * Time: 2:45
 */

namespace AppBundle\Application\Service\Notification;

/**
 * Class NotificationSender
 *
 * @package AppBundle\Application\Service
 */
/**
 * Class NotificationSender
 *
 * @package AppBundle\Application\Service
 */
class NotificationSender {

    /**
     * @var Notifier
     */
    private $notifier;

    /**
     * NotificationSender constructor.
     *
     * @param Notifier $notifier
     */
    public function __construct(Notifier $notifier) {
        $this->notifier = $notifier;
    }

    /**
     * @param Notification $content
     * @param NotificationType $action
     */
    public function __invoke(Notification $content, NotificationType $action) {
        $this->notifier->notify($content, $action);
    }
}