<?php

namespace framework\Http;

use framework\Http\Request;
use framework\Http\Response;

class Kernel
{
    protected $env;

    protected $routes;

    protected $globalVariables;

    public function __construct()
    {
        $this->setEnv($_SERVER['APP_ENV'] ?? "");
        $this->setRoutes(parse_ini_file(Kernel::getProjectDir() . 'config' . DIRECTORY_SEPARATOR . 'routes'));
        Kernel::$currentKernel = $this;
    }

    public function setEnv(string $env)
    {
        $this->env = $env;
        $gVariables = parse_ini_file(Kernel::getProjectDir() . '.env');
        if (!empty($env)) {
            $overrideVariables = parse_ini_file(Kernel::getProjectDir() . '.env.' . $env);
            $gVariables = array_merge($gVariables, $overrideVariables);
        }
        $this->globalVariables = $gVariables;
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function handle(Request $request): Response
    {
        $response = null;
        $currentPath = $request->basePath;
        if (array_key_exists($currentPath, $this->routes)) {
            $controllerToCall = explode(':', $this->routes[$currentPath]);
            $controllerClass = $controllerToCall[0];
            $controllerMethod = $controllerToCall[1];
            $controller = new $controllerClass();
            $controller->setGlobalVariables($this->globalVariables);
            $response = $controller->$controllerMethod($request);
        } else {
            $response = new Response();
            $response->setStatusCode(404);
            $response->setContent("PAGE NOT FOUND: The path <strong>$currentPath</strong> doesn't managed.");
        }
        return $response;
    }

    protected static $currentKernel;

    public static function getCurrent(): Kernel
    {
        return Kernel::$currentKernel;
    }

    public static function getProjectDir(): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
    }
}
