<?php


namespace AppBundle\Application\DataTransformer;


use AppBundle\Application\Service\Dto\CartProductDTO;

interface ArrayDataTransformerInterface
{
    public function write($object): void;

    public function read(): array;
}