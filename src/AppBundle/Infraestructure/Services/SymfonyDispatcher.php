<?php


namespace AppBundle\Infraestructure\Services;


use AppBundle\Application\Service\DispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SymfonyDispatcher implements DispatcherInterface
{
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * SymfonyDispatcher constructor.
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $eventName
     * @param $event
     */
    public function dispatch(string $eventName, $event): void
    {
        $this->dispatcher->dispatch($eventName, $event);
    }
}