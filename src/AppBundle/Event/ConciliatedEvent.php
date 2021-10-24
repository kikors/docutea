<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 21/08/2017
 * Time: 16:08
 */

namespace AppBundle\Event;

use AppBundle\Entity\SalesOrder;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ReconciliationEvent
 * @package AppBundle\Event
 */
final class ConciliatedEvent extends Event
{
    /**
     * @var SalesOrder
     */
    private $salesOrder;

    /**
     * ReconciliationEvent constructor.
     *
     * @param SalesOrder $salesOrder
     */
    public function __construct(SalesOrder $salesOrder)
    {
        $this->salesOrder = $salesOrder;
    }

    public function getSalesOrder(): SalesOrder
    {
        return $this->salesOrder;
    }

    public function getContractNumber(): string
    {
        return $this->salesOrder->getContractNumber();
    }
}