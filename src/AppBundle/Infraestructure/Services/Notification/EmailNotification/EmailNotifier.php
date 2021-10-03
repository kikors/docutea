<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/03/2018
 * Time: 3:55
 */

namespace AppBundle\Infraestructure\Services\Notification\EmailNotification;


use AppBundle\Application\Service\Notification\Notification;
use AppBundle\Application\Service\Notification\NotificationType;
use AppBundle\Application\Service\Notification\Notifier;
use AppBundle\Infraestructure\Exception\ImposibleSendNotify;
use AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailClient\FromTwigSwiftMailerEmailClient;
use Exception;
use Throwable;

/**
 * Class EmailNotifier
 *
 * @package AppBundle\Infraestructure\Services\Notification
 */
class EmailNotifier implements Notifier
{

    const DEFAULT_NOTIFICATION_SYBJECT = 'Notificación de docutea';

    /**
     * @var FromTwigSwiftMailerEmailClient
     */
    public $client;

    public $from;

    private $attachs;
    /**
     * @var string
     */
    private $template;

    /**
     * EmailNotifier constructor.
     * @param FromTwigSwiftMailerEmailClient $client
     * @param $from
     * @param string $template
     */
    public function __construct(FromTwigSwiftMailerEmailClient $client, $from, string $template = null) {
        $this->client = $client;
        $this->from = $from;
        $this->attachs = [];
        $this->template = $template;
    }

    /**
     * @param Notification $content
     * @param NotificationType $action
     *
     * @throws ImposibleSendNotify
     * @throws Throwable
     */
    public function notify(Notification $content, NotificationType $action) {
        if (!$this->from) {

            throw new ImposibleSendNotify('No se puede enviar la notificación, buzónm de salida vacío o tipo de contenido incorrecto');
        }

        switch ($action->value()) {
            case NotifierActions::NEW_SALES_ORDER_CREATE_USER_SUBJECT:
            case NotifierActions::NOTIFY_STORE_ORDER_CREATED:
                $subject = $action->value();
                /** @var EmailNotification $content */
                $target = $content->email();
                $this->client->send($this->from, $target, $subject, $content->value(), $this->attachs, $this->template);
                break;
            case NotifierActions::NOTIFY_STORE_ORDER_FAILED:
//                $subject = $action->value();
//                /** @var EmailNotificationContent $content */
//                $target = $content->email();
//                $this->client->send($this->from, $target, $subject, $content->value(), $this->attachs, $this->template);
                break;
            default:
                throw new ImposibleSendNotify('No se puede enviar la notificación, parámetros incorrectos');
        }
    }

    /**
     * @param $attachs
     * @throws Exception
     */
    public function setAttachs($attachs) {
        if (!is_array($attachs)) {

            throw new Exception(sprintf('Los adjuntos deben ser un array'));
        }

        $this->attachs = $attachs;
    }
}