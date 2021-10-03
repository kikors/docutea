<?php


namespace AppBundle\Application\Service\Exception;

use Exception;

class CantBuildCartProductException extends Exception
{
    /**
     * CantBuildCartProductException constructor.
     */
    public function __construct()
    {
        parent::__construct(sprintf('Imposible construir el producto'));
    }
}