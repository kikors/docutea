<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 19/10/2017
 * Time: 0:02
 */

namespace AppBundle\Services;


use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class SystemMailer {

    /**
     * @var Swift_Mailer
     */
    protected $mailer;

    /**
     * @var UrlGeneratorInterface
     */
    protected $router;

    /**
     * @var Environment
     */
    protected $twig;

    /**
     * SystemMailer constructor.
     * @param Swift_Mailer $mailer
     * @param Environment $twig
     */
    public function __construct(Swift_Mailer $mailer, Environment $twig) {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param array $fromEmail
     * @param string $toEmail
     *
     * @param string $subject
     * @param string $templateName
     * @param array $context
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function sendMessage($fromEmail, $toEmail, $subject, $templateName, $context) {
        $template = $this->twig->load($templateName);
        $subject = $template->renderBlock($subject);
        $htmlBody = $template->renderBlock('body_html', $context);

        $message = new Swift_Message($subject, $htmlBody, 'text/html');
        $message->setFrom($fromEmail);
        $message->setTo($toEmail);
        $this->mailer->send($message);
    }
}