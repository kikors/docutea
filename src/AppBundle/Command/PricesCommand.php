<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 07/08/2017
 * Time: 16:43
 */

namespace AppBundle\Command;


/**
 * Class PricesCommand
 * @package AppBundle\Command
 */
class PricesCommand
{
    /**
     * @var
     */
    private $fixedPrice;
    /**
     * @var
     */
    private $variablePrice;
    /**
     * @var
     */
    private $totalPrice;
    /**
     * @var
     */
   private $costByColorPage;
    private $costByBlackPage;

    /**
     * PricesCommand constructor.
     * @param $fixedPrice
     * @param $variablePrice
     * @param $costByColorPage
     * @param $costByBlackPage
     * @internal param $costByPage
     */
    public function __construct($fixedPrice, $variablePrice, $costByColorPage, $costByBlackPage)
    {
        $this->fixedPrice = $fixedPrice;
        $this->variablePrice = $variablePrice;
        $this->totalPrice = $this->fixedPrice + $this->variablePrice;
        $this->costByColorPage = $costByColorPage;
        $this->costByBlackPage = $costByBlackPage;
    }

    /**
     * @return mixed
     */
    public function getFixedPrice()
    {
        return $this->fixedPrice;
    }

    /**
     * @return mixed
     */
    public function getVariablePrice()
    {
        return $this->variablePrice;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->fixedPrice + $this->variablePrice;
    }

    /**
     * @return mixed
     */
    public function getCostByColorPage()
    {
        return $this->costByColorPage;
    }

    /**
     * @return mixed
     */
    public function getCostByBlackPage()
    {
        return $this->costByBlackPage;
    }

    /**
     * @return mixed|array
     */
    public function __toArray()
    {
        $result['fixedPrice'] = $this->getFixedPrice();
        $result['variablePrice'] = $this->getVariablePrice();
        $result['totalPrice'] = $this->getTotalPrice();
        $result['costByBlackPage'] = $this->getCostByBlackPage();
        $result['costByColorPage'] = $this->getCostByColorPage();

        return $result;
    }
}