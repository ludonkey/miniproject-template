<?php

namespace Entity;

use framework\Utils\Serializer;

class Card
{
    use Serializer;

    public int $id;
    public string $title;
    public string $text;
    public string $imageUrl;
}
