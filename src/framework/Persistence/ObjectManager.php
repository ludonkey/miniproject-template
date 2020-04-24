<?php

namespace framework\Persistence;

interface ObjectManager
{
    public function getRepository($className): ObjectRepository;
    public function persist($object): void;
    public function remove($object): void;
    public function flush(): void;
    public function contains($object): bool;
}