<?php

namespace Entity;

use ludk\Utils\Serializer;

class Image
{
    public int $id;
    public string $url;
    use Serializer;
}