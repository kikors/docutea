<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/06/2017
 * Time: 8:23
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\FormatType;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadFormatData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadFormatData
{
    /**
     * @var array
     */
    private $data = ['A3', 'A4'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $item) {
            $newItem = new FormatType();
            $newItem->setDescription($item);
            $manager->persist($newItem);
        }

        $manager->flush();
    }

}