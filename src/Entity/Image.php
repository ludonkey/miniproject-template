<?php

namespace Entity;

use framework\Utils\Serializer;

class Image
{
    public int $id;
    public string $url;
    use Serializer;
}