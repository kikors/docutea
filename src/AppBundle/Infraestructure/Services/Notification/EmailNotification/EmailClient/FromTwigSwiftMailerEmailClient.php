<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/03/2018
 * Time: 13:24
 */

namespace AppBundle\Infraestructure\Services\Notification\EmailNotification\EmailClient;

use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Throwable;
use Twig\Environment;
use Twig\TemplateWrapper;

/**
 * Class FromTwigSwiftMailerEmailClient
 *
 * @package AppBundle\Infraestructure\Services
 */
class FromTwigSwiftMailerEmailClient {

    /**
     * @var Swift_Mailer
     */
    private $client;

    /**
     * @var string
     */
    private $template;
    /**
     * @var Environment
     */
    private $templateService;


    /**
     * FromTwigSwiftMailerEmailClient constructor.
     * @param Swift_Mailer $swiftClient
     * @param Environment $templateService
     * @param string $template
     */
    public function __construct(Swift_Mailer $swiftClient, Environment $templateService, string $template) {
        $this->client = $swiftClient;
        $this->template = $template;
        $this->templateService = $templateService;
    }

    /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $text
     * @param array $attachs
     *
     * @param string|null $template
     * @throws Throwable
     */
    public function send($from, $to, $subject, $text, array $attachs, string $template = null) {
        if ($template) {
            $this->template = $template;
        }

        $message = new Swift_Message(
            $subject,
            $this->templateService->render($this->template, [
                'message' => $text
            ]),
            'text/html'
        );

        $message
            ->setFrom($from)
            ->setTo($to);
        if (count($attachs)) {
            foreach ($attachs as $attach) {
                $message->attach(
                    Swift_Attachment::fromPath($attach)
                );
            }
        }

        $this->client->send($message);
        //die('Enviado');
    }
}