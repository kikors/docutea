<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\StaticPages;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class StaticPagesRepository extends EntityRepository
{

    public function findOrEmpty($name)
    {
        $content = $this->findOneBy(['name' => $name]);

        if (!$content) {

            return new StaticPages();
        }

        return $content;
    }
}
