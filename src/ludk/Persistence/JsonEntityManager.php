<?php

namespace ludk\Persistence;

use ludk\Persistence\ObjectRepository;

final class JsonEntityManager implements ObjectManager
{
    private $allRepos;

    public function __construct()
    {
        $this->allRepos = array();
    }

    public function getRepository($className): ObjectRepository
    {
        if (!array_key_exists($className, $this->allRepos)) {
            $this->allRepos[$className] = new JsonRepository($className);;
        }
        return $this->allRepos[$className];
    }

    public function persist($object): void
    {
    }

    public function remove($object): void
    {
    }

    public function flush(): void
    {
    }

    public function contains($object): bool
    {
        return false;
    }
}