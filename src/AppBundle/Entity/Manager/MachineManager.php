<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 23/08/2017
 * Time: 16:27
 */

namespace AppBundle\Entity\Manager;


use AppBundle\StaticsClass\Configurer;

class MachineManager
{
    /**
     * Calcula el precio fijo de una máquina, el segundo argumento el es profit
     * del contrato según su duración.
     *
     * @param \AppBundle\Entity\Machine $machine
     * @param $profitDuration
     *
     * @return float
     */
    public function claculateFixedPrice($machine, $profitDuration) {
        if (!$machine) {

            return 0;
        }
        return $machine->getMachineFixedPrice() * (1 + $profitDuration / 100) / Configurer::CAREPACK_DEFAULT_DURATION;
    }
}