<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/06/2017
 * Time: 8:23
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\TonerCapacity;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadTonerCapacityData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadTonerCapacityData
{
    /**
     * @var array
     */
    private $data = ['Incluido', 'Estandar', 'Alta Capacidad'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $item) {
            $newItem = new TonerCapacity();
            $newItem->setDescription($item);
            $manager->persist($newItem);
        }

        $manager->flush();
    }

}