<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Application\Service\Dto\CartProductDTO;

interface CartProductDTODataTransformerInterface
{
    public function write($object): void;

    public function read(): CartProductDTO;
}