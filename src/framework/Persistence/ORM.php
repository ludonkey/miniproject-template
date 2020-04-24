<?php

namespace framework\Persistence;

use framework\Persistence\ObjectManager;
use framework\Persistence\ObjectRepository;

class ORM
{
    public function getManager(): ObjectManager
    {
        return ManagerRegistry::getManager();
    }

    public function getRepository($classname): ObjectRepository
    {
        return ManagerRegistry::getRepository($classname);
    }
}