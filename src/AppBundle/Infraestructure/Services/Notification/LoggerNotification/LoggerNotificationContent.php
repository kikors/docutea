<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 09/03/2018
 * Time: 6:39
 */

namespace AppBundle\Infraestructure\Services\Notification\LoggerNotification;


/**
 * Class LoggerNotificationContent
 *
 * @package AppBundle\Infraestructure\Services\Notification
 */
class LoggerNotificationContent implements LogNotification {

    /**
     * @var
     */
    private $channel;

    /**
     * @var
     */
    private $message;

    /**
     * LoggerNotificationContent constructor.
     *
     * @param $channel
     * @param $message
     */
    public function __construct($channel, $message) {
        $this->channel = $channel;
        $this->message = $message;
    }

    /**
     *
     */
    public function channel() {
        $this->channel;
    }

    /**
     *
     */
    public function value() {
        $this->message;
    }
}