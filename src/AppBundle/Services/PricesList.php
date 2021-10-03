<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 07/08/2017
 * Time: 16:22
 */

namespace AppBundle\Services;

use AppBundle\Command\PricesCommand;
use AppBundle\Entity\Manager\MachineManager;
use AppBundle\Entity\Manager\SalesOrderManager;
use AppBundle\StaticsClass\PricesCalculation;
use Doctrine\ORM\EntityManager;

/**
 * Class PricesList
 * @package AppBundle\Services
 */
class PricesList
{

    private $carePackProfitRepository;

    private $machineManager;

    private $salesOrderManager;

    /**
     * PricesList constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param \AppBundle\Entity\Manager\MachineManager $machineManager
     * @param \AppBundle\Entity\Manager\SalesOrderManager $salesOrderManager
     */
    public function __construct(EntityManager $em, MachineManager $machineManager, SalesOrderManager $salesOrderManager)
    {
        $this->carePackProfitRepository = $em->getRepository('AppBundle:CarePackProfit');
        $this->machineManager = $machineManager;
        $this->salesOrderManager = $salesOrderManager;
    }

    /**
     * @param array $machineList
     * @param null $duration
     * @param null $pages
     * @param null $colorPercent
     *
     * @return null
     * @throws \Exception
     */
    public function getPricesList(array $machineList, $duration = null, $pages = null, $colorPercent= null) {
        $result = null;
        if (empty($machineList)) {

            return $result;
        };
        foreach ($machineList as $machine) {

            /**@var $machine \AppBundle\Entity\Machine */
            $item =  new PricesCommand(
                $this->machineManager->claculateFixedPrice($machine, $this->carePackProfitRepository->getProfitByDuration($duration)),
                $this->salesOrderManager->calculateVariablePrice($machine, $pages, $colorPercent),
                $machine->getColorPageCost(),
                $machine->getBlackPageCost()
            );
            $result[$machine->getId()] = $item->__toArray();
        };
        return $result;
    }
}