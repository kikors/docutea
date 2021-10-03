<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/06/2017
 * Time: 8:23
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\FunctionalityType;
use AppBundle\Entity\Maker;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadMakerData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadMakerData
{
    /**
     * @var array
     */
    private $data = ['HP', 'Canon', 'Lexmark', 'Ricoh', 'Samsung'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $item) {
            $newItem = new Maker();
            $newItem->setDescription($item);
            $manager->persist($newItem);
        }

        $manager->flush();
    }

}