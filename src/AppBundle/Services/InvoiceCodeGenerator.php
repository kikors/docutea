<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 29/10/2017
 * Time: 1:15
 */

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

/**
 * Class InvoiceCodeGenerator
 *
 * @package AppBundle\Services
 */
class InvoiceCodeGenerator {

    /**
     * @var \AppBundle\Entity\Repository\InvoiceRepository|\Doctrine\ORM\EntityRepository
     */
    private $invoiceRepository;

    /**
     * InvoiceCodeGenerator constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em) {

        $this->invoiceRepository = $em->getRepository('AppBundle:Invoice');
    }

    /**
     * @param $invoiceType
     *
     * @return string
     */
    public function generate($invoiceType) {
        $date = new \DateTime();
        $number = str_pad(strval($this->lastNumber($invoiceType) + 1), 4, "0", STR_PAD_LEFT);
        return $date->format('Y').'/'.$invoiceType.$number;
    }

    /**
     * @param $type
     *
     * @return int
     */
    private function lastNumber($type) {
        $number = $this->invoiceRepository->lastNumber($type);

        return str_pad(strval($number), 4, "0", STR_PAD_LEFT);
    }
}