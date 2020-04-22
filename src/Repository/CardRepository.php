<?php

namespace Repository;

use framework\Repository\JsonRepository;

class CardRepository extends JsonRepository
{
    public function __construct()
    {
        $jsonFile = __DIR__ . '/../Resources/cards.json';
        parent::__construct("Entity\Card", $jsonFile);
    }
}
