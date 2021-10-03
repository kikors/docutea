<?php


namespace AppBundle\Application\Service;


interface ApplicationServiceInterface
{
    public function execute($orderDto=null): void;
}