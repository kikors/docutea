<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 08/10/2017
 * Time: 18:43
 */

namespace AppBundle\Services;


/**
 * Class DateTools
 *
 * @package AppBundle\Services
 */
class DateTools {

    /**
     * Devuelve la diferencia en meses entre dos fechas determinadas
     *
     * @param \DateTime $date1
     * @param \DateTime $date2
     *
     * @return string
     * @throws \Exception
     */
    public function getDifInMonth($date1, $date2) {
        if (!$date1 && !$date2) {

            return 0;
        }
        if (!$date1) {

            return strval($date2->format("%m")) + strval($date2->format("%y") * 12 + strval($date2->format("%d")) / 30);
        }
        if (!$date2) {
            $date2 = new \DateTime();
        }
        $interval = $date1->diff($date2);
        return strval($interval->format("%m")) + strval($interval->format("%y") * 12 + strval($interval->format("%d") / 30));
    }

    /**
     * Devuelve la fecha del dia 1 del mes en curso
     *
     * @return \DateTime
     */
    public function firstDay() {
        $now = new \DateTime();

        return new \DateTime('1-'.$now->format('m').'-'.$now->format('Y'));
    }
}