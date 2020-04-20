<?php

namespace framework\Entity;

class Request
{
    // incoming headers (User-Agent, etc)
    public $headers;

    // GET or POST or HEAD ...
    public $method;

    // http://localhost/web/index.php?var=1 contains '/web'
    public $basePath;

    // $_POST parameters
    public $request;

    // $_GET parameters
    public $query;

    // $_SERVER infos
    public $server;

    public function __construct()
    {
        $this->initialize($_GET, $_POST, $_SERVER);
    }

    public function initialize(array $query = [], array $request = [], array $server = [])
    {
        $this->query = $query;
        $this->request = $request;
        $this->server = $server;
        $this->headers = getallheaders();
        $this->basePath = parse_url($server['REQUEST_URI'], PHP_URL_PATH);
        $this->method = $server['REQUEST_METHOD'];
    }
}
