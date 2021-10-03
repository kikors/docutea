<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 07/08/2017
 * Time: 16:22
 */

namespace AppBundle\Services;


use AppBundle\Entity\Machine;

class RecomendedPrinter
{
    public static function getPrinter(array $machineList, Machine $machine = null) {
        if (empty($machineList) && !$machine) {

            return null;
        }
        if ($machine) {

            return $machine;
        }
        foreach ($machineList as $machine) {
            /**@var $machine \AppBundle\Entity\Machine */
            if ($machine->isRecomended()) {

                return $machine;
            }
        }

        return $machineList[0];
    }
}