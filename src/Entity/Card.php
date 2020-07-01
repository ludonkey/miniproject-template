<?php

namespace Entity;

use Entity\User;
use ludk\Utils\Serializer;

class Card
{
    public int $id;
    public string $title;
    public string $text;
    public string $link;
    public Image $image;
    public User $user;
    use Serializer;
}
