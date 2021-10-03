<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 23/08/2017
 * Time: 16:27
 */

namespace AppBundle\Entity\Manager;

use AppBundle\Entity\Machine;
use AppBundle\StaticsClass\TonerColors;

class TonerManager
{
    /**
     * @param $pages
     * @param $recomended
     *
     * @return float|int
     */
    public function calculateTonerYearAmount($pages, $recomended) {

        return $pages * 12 / $recomended;
    }

//    /**
//     * @param \AppBundle\Entity\Machine $machine
//     * @param array $color
//     *
//     * @return float|int
//     * @throws \Exception
//     */
//    public function getTonerPrice($machine, $color) {
//        if (!$machine) {
//
//            return 0;
//        }
//        if ($color === TonerColors::BLACK) {
//
//            return $machine->getBlackPageCost() * $this->getToner($machine, $color)
//                    ->getRecomendedVolume();
//        }
//
//        return $machine->getColorPageCost() * $machine->getTonerColor()
//                ->getRecomendedVolume();
//    }

//    /**
//     * @param Machine $machine
//     * @param array $colors
//     *
//     * @return \AppBundle\Entity\Toner|null
//     * @internal param $color
//     */
//    public function getToner($machine, array $colors)
//    {
//        foreach ($machine->getToners() as $toner) {
//            if (in_array($toner->getColorDescrition(), $colors)) {
//
//                return $toner;
//            }
//        }
//
//        return null;
//    }
}