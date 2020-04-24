<?php

namespace framework\Persistence;

use framework\Persistence\ObjectManager;
use framework\Persistence\ObjectRepository;

class ManagerRegistry
{
    private static ObjectManager $manager;

    public static function getManager(): ObjectManager
    {
        if (empty(self::$manager)) {
            self::$manager = new JsonEntityManager();
        }
        return self::$manager;
    }

    public static function getRepository($classname): ObjectRepository
    {
        return ManagerRegistry::getManager()->getRepository($classname);
    }
}