<?php

namespace Entity;

use framework\Utils\Serializer;

class Card
{
    public int $id;
    public string $title;
    public string $text;
    public Image $image;
    use Serializer;
}