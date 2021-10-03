<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/06/2017
 * Time: 8:23
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\FunctionalityType;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadFunctionData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadFunctionData
{
    /**
     * @var array
     */
    private $data = ['Impresora', 'Multifunción'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $item) {
            $newItem = new FunctionalityType();
            $newItem->setDescription($item);
            $manager->persist($newItem);
        }

        $manager->flush();
    }

}