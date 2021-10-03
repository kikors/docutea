<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 07/08/2017
 * Time: 16:22
 */

namespace AppBundle\Services;


/**
 * Class TransformMachineArray
 *
 * @package AppBundle\Services
 */
class TransformMachineArray
{

    /**
     * @param array $machineList
     *
     * @return array|null
     * @throws \Exception
     */
    public static function transform(array $machineList) {
        $result = null;
        if (empty($machineList)) {

            return $result;
        }
        foreach ($machineList as $machine) {
            /**@var $machine \AppBundle\Entity\Machine */
            $result[] =  $machine->__toArray();
        }

        return $result;
    }
}