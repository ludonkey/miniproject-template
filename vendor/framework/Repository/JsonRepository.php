<?php

namespace framework\Repository;

use framework\Repository\EntityRepository;

class JsonRepository implements EntityRepository
{
    private string $class;
    private string $idFieldName;
    private array $objectsById;

    public function __construct(string $class, string $jsonFile, string $idFieldName = "id")
    {
        $this->objectsById = array();
        $this->class = $class;
        $this->idFieldName = $idFieldName;
        $jsonStr = file_get_contents($jsonFile);
        $jsonArray = json_decode($jsonStr, true);
        foreach ($jsonArray as $oneObjectJson) {
            $newObj = new $this->class();
            $newObj->LoadFromJson($oneObjectJson);
            $this->objectsById[$newObj->{$this->idFieldName}] = $newObj;
        }
    }

    public function find($id)
    {
        if (array_key_exists($id, $this->objectsById))
            return $this->objectsById[$id];
        else
            return null;
    }

    public function findAll()
    {
        return array_values($this->objectsById);
    }

    public function findBy(array $criteria = [], array $orderBy = [], int $limit = -1, int $offset = 0)
    {
        $res = array();
        foreach ($this->objectsById as $key => $oneObj) {
            if (JsonRepository::isObjectValid($oneObj, $criteria)) {
                $res[] = $oneObj;
            }
        }
        if (!empty($orderBy)) {
            foreach ($orderBy as $key => $order) {
                usort($res, array(new MySortCallback($key, $order), "call"));
                break;
            }
        }
        if ($limit > -1) {
            $res = array_slice($res, $offset, $limit);
        }
        return $res;
    }

    public function count(array $criteria = [])
    {
        return count($this->findBy($criteria));
    }

    private static function isObjectValid($obj, $criteria)
    {
        foreach ($criteria as $fieldName => $value) {
            if (preg_match('/' . $value . '/', $obj->$fieldName) == 0) {
                return false;
            }
        }
        return true;
    }
}

class MySortCallback
{
    private $key;
    private $order;

    function __construct($key, $order)
    {
        $this->key = $key;
        $this->order = $order;
    }

    function call($a, $b)
    {
        $v1 = $a->{$this->key};
        $v2 = $b->{$this->key};
        return strcmp($v1, $v2) * ($this->order == "ASC" ? 1 : -1);
    }
}
