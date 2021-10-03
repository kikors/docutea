<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/06/2017
 * Time: 8:23
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Technology;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadTechnologyData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadTechnologyData
{
    /**
     * @var array
     */
    private $data = ['Láser', 'Tinta Pro'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $item) {
            $newItem = new Technology();
            $newItem->setDescription($item);
            $manager->persist($newItem);
        }

        $manager->flush();
    }

}