<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/06/2017
 * Time: 8:23
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\FormatType;
use AppBundle\Entity\TonerColor;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadTonerColorData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadTonerColorData
{
    /**
     * @var array
     */
    private $data = ['Negro', 'Cyan', 'Magenta', 'Amarillo'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $item) {
            $newItem = new TonerColor();
            $newItem->setDescription($item);
            $manager->persist($newItem);
        }

        $manager->flush();
    }

}