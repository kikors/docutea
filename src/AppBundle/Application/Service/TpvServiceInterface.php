<?php


namespace AppBundle\Application\Service;


interface TpvServiceInterface
{
    public function makePayment(): void;

    public function checkPayment(): void;
}