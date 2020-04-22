<?php

use framework\Http\Kernel;
use framework\Http\Request;

require '../vendor/autoload.php';

$kernel = new Kernel();
$request = new Request($_GET, $_POST, $_SERVER);
$response = $kernel->handle($request);
$response->send();
