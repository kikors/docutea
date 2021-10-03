<?php


namespace AppBundle\Application\DataTransformer;


interface JsonDataTransformerInterface
{
    public function write($object): void;

    public function read(): string;
}