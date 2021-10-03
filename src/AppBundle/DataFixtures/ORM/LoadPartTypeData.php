<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 18/06/2017
 * Time: 8:23
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\PartType;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadPartTypeData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadPartTypeData
{
    /**
     * @var array
     */
    private $data = ['Tambor', 'Kit Mantenimiento Fusor', 'Kit de Transferencia', 'Kit de Rodillos', 'Kit de Mantenimiento ADF', 'Kit de Toner Residual'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $item) {
            $newItem = new PartType();
            $newItem->setDescription($item);
            $manager->persist($newItem);
        }

        $manager->flush();
    }

}