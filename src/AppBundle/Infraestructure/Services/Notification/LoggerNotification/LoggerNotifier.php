<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/03/2018
 * Time: 3:55
 */

namespace AppBundle\Infraestructure\Services\Notification\LoggerNotification;


use AppBundle\Application\Service\Notification\Notification;
use AppBundle\Application\Service\Notification\NotificationType;
use AppBundle\Application\Service\Notification\Notifier;
use AppBundle\Infraestructure\Services\FromTwigSwiftMailerEmailClient;
use Monolog\Logger;

/**
 * Class LoggerNotifier
 *
 * @package AppBundle\Infraestructure\Services\Notification
 */
class LoggerNotifier implements Notifier {

    const DEFAULT_CHANNEL = 'info';
    /**
     * @var FromTwigSwiftMailerEmailClient
     */
    private $logger;

    /**
     * EmailNotifier constructor.
     *
     * @param \Monolog\Logger $logger
     */
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    /**
     * @param Notification $content
     * @param NotificationType $action
     *
     * @throws \Throwable
     */
    public function notify(Notification $content, NotificationType $action) {
        $channel = $content->channel();
        if (!$channel) {

            $channel = self::DEFAULT_CHANNEL;
        }

        $this->logger->log($channel, $content->value());
    }
}