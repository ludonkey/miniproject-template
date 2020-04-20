<?php

use framework\Entity\Kernel;
use framework\Entity\Request;

require '../vendor/autoload.php';

$kernel = new Kernel();
$request = new Request($_GET, $_POST, $_SERVER);
$response = $kernel->handle($request);
$response->send();
