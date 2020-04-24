<?php

namespace ludk\Persistence;

use ludk\Persistence\ObjectManager;
use ludk\Persistence\ObjectRepository;

class ManagerRegistry
{

    public static function reset(): void {
        unset($_SESSION['OBJECT_MANAGER']);
    }

    public static function getManager(): ObjectManager
    {
        if (empty($_SESSION['OBJECT_MANAGER'])) {
            $_SESSION['OBJECT_MANAGER'] = new JsonEntityManager();
        }
        return $_SESSION['OBJECT_MANAGER'];
    }

    public static function getRepository($classname): ObjectRepository
    {
        return ManagerRegistry::getManager()->getRepository($classname);
    }
}