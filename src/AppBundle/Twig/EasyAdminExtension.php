<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 28/10/2017
 * Time: 8:12
 */

namespace AppBundle\Twig;


use AppBundle\Entity\PermittedActionsInterface;
use AppBundle\Entity\SalesOrder;
use AppBundle\Entity\User;

/**
 * Class EasyAdminExtension
 *
 * @package AppBundle\Twig
 */
class EasyAdminExtension extends \Twig_Extension {

    /**
     * @return array
     */
    public function getFilters() {
        return [
            new \Twig_SimpleFilter(
                'filter_actions',
                [$this, 'filterActions']
            ),
        ];
    }

    /**
     * @param array $itemActions
     * @param $item
     *
     * @return array
     */
    public function filterActions(array $itemActions, $item) {
        if ($item instanceof PermittedActionsInterface && !$item->isDeletable()) {
            unset($itemActions['delete']);
        }

        if ($item instanceof SalesOrder && !$item->isDeletable()) {
            unset($itemActions['delete']);
            unset($itemActions['edit']);
        }

        if ($item instanceof SalesOrder && !$item->isClosable()) {
            unset($itemActions['conciliation']);
            unset($itemActions['terminate']);
        }

        if ($item instanceof User && !$item->isDeletable()) {
            unset($itemActions['delete']);
            //unset($itemActions['edit']);
        }

        return $itemActions;
    }

    /**
     * @return string
     */
    public function getName() {
        return 'app_filter_actions';
    }
}