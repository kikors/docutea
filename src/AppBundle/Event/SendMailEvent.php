<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/10/2017
 * Time: 16:36
 */

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class NewSalesOrderEvent
 *
 * @package AppBundle\Event
 */
class SendMailEvent extends Event {
    private $from;
    private $to;
    private $subject;
    private $context;
    private $template;


    /**
     * NewSalesOrderEvent constructor.
     *
     * @param $from
     * @param $to
     * @param $subject
     * @param $context
     * @param $template
     */
    public function __construct($from, $to, $subject, $context, $template) {
        $this->from = $from;
        $this->to = $to;
        $this->context = $context;
        $this->template = $template;
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getFrom() {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getTo() {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @return mixed
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * @return mixed
     */
    public function getSubject() {
        return $this->subject;
    }
}
