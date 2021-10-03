<?php
/**
 * Created by PhpStorm.
 * User: javier.mares
 * Date: 10/07/2017
 * Time: 13:45
 */

namespace AppBundle\Entity\Manager;


use AppBundle\Entity\Machine;
use AppBundle\Entity\SalesOrder;
use AppBundle\Event\NewSalesOrderEvent;
use AppBundle\Services\DateTools;
use AppBundle\StaticsClass\Configurer;
use AppBundle\StaticsClass\SalesOrderStates;
use AppBundle\StaticsClass\TonerColors;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

/**
 * Class SalesOrderManager
 *
 * @package AppBundle\Entity\Manager
 */
class SalesOrderManager {

    /**
     * @var \AppBundle\Services\DateTools
     */
    private $dateTool;

    /**
     * @var
     */
    private $defaultDuration;

    /**
     * @var \AppBundle\Entity\Repository\CarePackProfitRepository|\Doctrine\ORM\EntityRepository
     */
    private $profitDurationRepository;

    /**
     * @var
     */
    private $defaultPages;

    /**
     * @var
     */
    private $defaultPercent;

    /**
     * SalesOrderManager constructor.
     *
     * @param \AppBundle\Services\DateTools $dateTool
     * @param $defaultDuration
     * @param \Doctrine\ORM\EntityManager $em
     * @param $defaultPages
     * @param $defaultPercent
     */
    public function __construct(DateTools $dateTool, EntityManager $em, $defaultDuration, $defaultPages, $defaultPercent) {
        $this->dateTool = $dateTool;
        $this->defaultDuration = $defaultDuration;
        $this->profitDurationRepository = $em->getRepository('AppBundle:CarePackProfit');
        $this->defaultPages = $defaultPages;
        $this->defaultPercent = $defaultPercent;
    }

    /**
     * @return \AppBundle\Entity\SalesOrder
     */
    public function createBlanc() {
        $blancSalesOrder = new SalesOrder();
        $blancSalesOrder->setContractNumber($this->generateContracNumber());
        $blancSalesOrder->setPages($this->countPages($this->defaultPages));
        $blancSalesOrder->setDuration($this->duration($this->defaultDuration));
        $blancSalesOrder->setProfitDuration($this->profitDurationRepository->getProfitByDuration($this->defaultDuration));
        $blancSalesOrder->setColorPercent($this->defaultPercent);
        $blancSalesOrder->setProfitVariable(1);
        $blancSalesOrder->setProfitFixed(1);

        return $blancSalesOrder;
    }

    /**
     * @param \AppBundle\Event\NewSalesOrderEvent $event
     *
     * @return \AppBundle\Entity\SalesOrder
     * @throws \Exception
     */
    public function createNew(NewSalesOrderEvent $event) {
        $newSalesOrder = new SalesOrder();
        $newSalesOrder->setContractNumber($this->generateContracNumber());
        $newSalesOrder->setProfitVariable(1);
        $newSalesOrder->setProfitFixed(1);
        $newSalesOrder->setProfitDuration($this->profitDurationRepository->getProfitByDuration($event->getDuration()));
        $newSalesOrder->setMachine($event->getMachine());
        $newSalesOrder->setPages($this->countPages($event->getPages()));
        $newSalesOrder->setDuration($this->duration($event->getDuration()));
        $newSalesOrder->setColorPercent($this->colorPercent($event->getMachine(), $event->getColorPercent()));
        $newSalesOrder->setCostumer($event->getUser());
        $newSalesOrder->setCostumerAdress($event->getAddress());
        $newSalesOrder->setState(SalesOrderStates::IN_PROCESS);
        $newSalesOrder->setInvoices(new ArrayCollection());
        $newSalesOrder->setSentConsumables(new ArrayCollection());
        $newSalesOrder->setCostumerAdress($event->getAddress());

        $newSalesOrder->setCreatedAt(new \DateTime());
        $newSalesOrder->setResume($newSalesOrder->getContractNumber().'_info.pdf');
        $this->recalculate($newSalesOrder);


        return $newSalesOrder;

    }

    /**
     * @param \AppBundle\Entity\SalesOrder $order
     *
     * @return \AppBundle\Entity\SalesOrder
     * @throws \Exception
     */
    public function replicate($order) {
        if (!$order) {

            return new SalesOrder();
        }
        $reconciliationDate = $this->getReconciliationDate();
        $newOrder = clone $order;
        $newOrder->setState(SalesOrderStates::ACCEPTED);
        $newOrder->setDuration($this->contractRestTime($order));
        $newOrder->setCreatedAt($reconciliationDate);
        $newOrder->setAcceptedAt($reconciliationDate);
        $newOrder->setParent($order);
        $newOrder->setInvoices(new ArrayCollection());
        $newOrder->setContractNumber($this->generateContracNumber());

        return $newOrder;
    }

    /**
     * @return \DateTime
     */
    private function getReconciliationDate() {
        $date = new \DateTime();

        return new \DateTime('1-' . $date->format('m') . '-' . $date->format('Y'));
    }

    /**
     * Devulve el tiempo que resta de un contrato
     *
     * @param SalesOrder $order
     *
     * @return string
     * @throws \Exception
     */
    private function contractRestTime($order) {
        if (!$order) {
            return $this->defaultDuration;
        }
        return $order->getDuration() - $this->dateTool->getDifInMonth($order->getAcceptedAt(), $this->getReconciliationDate());
    }

    /**
     * @return string
     */
    private function generateContracNumber() {
        $year = new \DateTime();
        return $year->getTimestamp() . '-' . $year->format('Y');
    }

    /**
     * @param $pages
     *
     * @return mixed
     */
    private function countPages($pages) {
        if ($pages < $this->defaultPages) {

            return $this->defaultPages;
        }

        return $pages;
    }

    /**
     * @param $duration
     *
     * @return mixed
     */
    private function duration($duration) {
        if ($duration < $this->defaultDuration) {

            return $this->defaultDuration;
        }

        return $duration;
    }

    /**
     * @param Machine $machine
     * @param $colorPercent
     *
     * @return mixed
     */
    private function colorPercent($machine, $colorPercent) {
        if (strtoupper($this->getMachineChromaName($machine)) !== strtoupper(Configurer::COLOR_PRINTER_NAME)) {


            return 0;
        }
        if ($colorPercent < $this->defaultPercent) {

            return $this->defaultPercent;
        }

        return $colorPercent;
    }

    /**
     * @param \AppBundle\Entity\Machine $machine
     *
     * @return null|string
     */
    private function getMachineChromaName(Machine $machine) {
        if (!$machine || !$machine->getChromaType()) {

            return NULL;
        }

        return $machine->getChromaType()->getDescription();
    }

    /**
     * @param SalesOrder $salesOrder
     *
     * @return \AppBundle\Entity\SalesOrder
     * @throws \Exception
     */
    public function recalculate($salesOrder) {
        $salesOrder->setFixedPrice($this->calculateFixedPrice($salesOrder));
        $salesOrder->setAmountBlack($this->calculateTonerYear($salesOrder, TonerColors::BLACK));
        $salesOrder->setAmountColor($this->calculateTonerYear($salesOrder, TonerColors::CYAN));
        $salesOrder->setVariablePrice($this->calculateVariablePrice($salesOrder->getMachine(), $salesOrder->getPages(), $salesOrder->getColorPercent()));
        $salesOrder->setMonthPrice($salesOrder->getFixedPrice() + $salesOrder->getVariablePrice());

        return $salesOrder;
    }

    /**
     * @param SalesOrder $salesOrder
     *
     * @return float
     */
    private function calculateFixedPrice($salesOrder) {
        return $salesOrder->getMachineFixedPrice() * (1 + $salesOrder->getProfitDuration() / 100) / Configurer::CAREPACK_DEFAULT_DURATION * $salesOrder->getProfitFixed();
    }

    /**
     * @param SalesOrder $salesOrder
     *
     * @return float
     */
    private function totalTonerPrice($salesOrder) {
        return ($salesOrder->getAmountBlack() * $salesOrder->getPriceTonerBlack()) + ($salesOrder->getAmountColor() * $salesOrder->getPriceTonerColor());
    }

    /**
     * @param SalesOrder $salesOrder
     * @param $color
     *
     * @return float|int
     */
    public function calculateTonerYear($salesOrder, $color) {
        if ($color === TonerColors::BLACK) {

            return round($this->calculateTonerYearAmount($salesOrder->getPages(), $salesOrder->getTonerBlackRecomendedVolume()), 2);
        }

        return round($this->calculateTonerYearAmount($salesOrder->getPages() * $salesOrder->getColorPercent() / 100, $salesOrder->getTonerColorRecomendedVolume()), 2);
    }

    /**
     * @param $pages
     * @param $recomended
     *
     * @return float|int
     */
    private function calculateTonerYearAmount($pages, $recomended) {
        if (!$recomended) {

            return 0;
        }

        return $pages * 12 / $recomended;
    }

    /**
     * devuelve el precio variable por mes de una máquina determinada
     * dados duración, páginas y porciento de color
     *
     * @param Machine $machine
     * @param $pages
     * @param $colorPercent
     *
     * @return float|int
     * @throws \Exception
     */
    public function calculateVariablePrice($machine, $pages, $colorPercent) {
        if (!$machine) {

            return 0;
        }
        $blackPages = ($colorPercent) ? $pages - ($pages * $colorPercent / 100) : $pages;
        $colorPages = $pages * $colorPercent / 100;
        $blackVariablePrice = $this->calculateTonerYearAmount(
                $blackPages, $machine->getTonerBlack()->getRecomendedVolume()
            ) * $machine->getBlackTonerPrice();
        if (!$machine->isColor()) {
            return $blackVariablePrice / 12;
        }

        $colorVariablePrice = $this->calculateTonerYearAmount(
                $colorPages, $machine->getTonerColor()->getRecomendedVolume()
            ) * $machine->getColorTonerPrice();
        $BlackRemanentTonerAmount = $this->calculateTonerYearAmount($colorPages, $machine->getTonerBlack()->getRecomendedVolume());
        return ($blackVariablePrice + $colorVariablePrice*3 + $BlackRemanentTonerAmount * $machine->getBlackTonerPrice()) / 12;
    }
}