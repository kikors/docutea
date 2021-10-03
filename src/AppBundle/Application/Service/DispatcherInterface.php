<?php


namespace AppBundle\Application\Service;


interface DispatcherInterface
{
    public function dispatch(string $eventName, $event): void;
}