<?php


namespace AppBundle\Application\DataTransformer;

use AppBundle\Application\Service\Dto\ShoppingCartDTO;

interface ShoppingCartDTODataTransformerInterface
{
    public function write($object): void;

    public function read(): ShoppingCartDTO;
}