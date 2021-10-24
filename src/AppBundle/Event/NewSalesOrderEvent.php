<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/10/2017
 * Time: 16:36
 */

namespace AppBundle\Event;


use AppBundle\Entity\Machine;
use AppBundle\Entity\User;
use AppBundle\StaticsClass\Serials;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class NewSalesOrderEvent
 *
 * @package AppBundle\Event
 */
final class NewSalesOrderEvent extends Event {

    /**
     * @var User
     */
    private $user;

    /**
     * @var Machine
     */
    private $machine;

    /**
     * @var
     */
    private $address;

    /**
     * @var
     */
    private $colorPercent;

    /**
     * @var
     */
    private $duration;

    /**
     * @var
     */
    private $pages;

    /**
     * NewSalesOrderEvent constructor.
     *
     * @param User $user
     * @param Machine $machine
     * @param $duration
     * @param $pages
     * @param $colorPercent
     * @param $address
     */
    public function __construct(Machine $machine, $duration, $pages, $colorPercent, User $user = null, $address = null) {
        $this->user = $user;
        $this->machine = $machine;
        $this->duration = $duration;
        $this->pages = $pages;
        $this->colorPercent = $colorPercent;
        if ($address) {
            $this->address = $this->transformAddress($address);
        }

    }

    /**
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @return Machine
     */
    public function getMachine() {
        return $this->machine;
    }

    /**
     * @return mixed
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getColorPercent() {
        return $this->colorPercent;
    }

    /**
     * @return mixed
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function getPages() {
        return $this->pages;
    }

    private function transformAddress($address) {
        $resultAddress = '';
        foreach ($address as $key => $value) {
            if ($key === 'provincia') {
                $resultAddress = $resultAddress.ucfirst($key).' : '.Serials::getProvinceName($value).', ';
            } else {
                $resultAddress = $resultAddress.ucfirst($key).' : '.$value.', ';
            }

        }

        return $resultAddress;
    }
}