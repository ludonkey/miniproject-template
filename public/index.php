<?php

use ludk\Http\Kernel;
use ludk\Http\Request;

require '../vendor/autoload.php';

$kernel = new Kernel();
$request = new Request($_GET, $_POST, $_SERVER, $_COOKIE);
$response = $kernel->handle($request);
$response->send();
