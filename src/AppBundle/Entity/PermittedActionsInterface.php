<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 24/10/2017
 * Time: 1:15
 */

namespace AppBundle\Entity;


/**
 * Interface PermittedActionsInterface
 *
 * @package AppBundle\Entity
 */
Interface PermittedActionsInterface {

    /**
     * @return boolean
     */
    function isDeletable();

}