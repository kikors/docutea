<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 07/08/2017
 * Time: 16:22
 */

namespace AppBundle\Services;


use AppBundle\Entity\Machine;

/**
 * Class DefaultColorPercent
 * @package AppBundle\Services
 */
class DefaultColorPercent
{
    /**
     * @var
     */
    private $defaultColorPercentParam;

    /**
     * DefaultColorPercent constructor.
     * @param $defaultColorPercentParam
     */
    public function __construct($defaultColorPercentParam)
    {
        $this->defaultColorPercentParam = $defaultColorPercentParam;
    }

    /**
     * @param Machine|null $machine
     * @return int
     */
    public function getColorPercent(Machine $machine = null) {
        if (!$machine || $machine->isColor()) {

            return $this->defaultColorPercentParam;
        }

        return 0;
    }
}