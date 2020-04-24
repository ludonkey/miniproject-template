<?php

use ludk\Http\Kernel;
use ludk\Http\Request;

require '../vendor/autoload.php';

$kernel = new Kernel();
$request = new Request($_GET, $_POST, $_SERVER);
$response = $kernel->handle($request);
$response->send();
