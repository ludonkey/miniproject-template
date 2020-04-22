<?php

namespace framework\Repository;

interface EntityRepository
{
    public function find($id);
    public function findAll();
    public function findBy(array $criteria = [], array $orderBy = [], int $limit = -1, int $offset = 0);
    public function count(array $criteria = []);
}
