<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/10/2017
 * Time: 21:56
 */

namespace AppBundle\Listener;


use AppBundle\Event\SendMailEvent;
use AppBundle\Services\SystemMailer;
use Exception;
use Throwable;

class SendMailListener {

    private $mailer;

    /**
     * ConfirmationMailListener constructor.
     *
     * @param SystemMailer $mailer
     */
    public function __construct(SystemMailer $mailer) {
        $this->mailer = $mailer;
    }

    public function onSendMail(SendMailEvent $event) {
        try {
            $this->mailer->sendMessage(
                $event->getFrom(), $event->getTo(), $event->getSubject(),
                $event->getTemplate(), $event->getContext()
            );
        } catch (Exception $e) {
        } catch (Throwable $e) {
        }
    }

}