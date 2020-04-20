<?php

namespace framework\Controller;

use framework\Entity\Kernel;
use framework\Entity\Response;

abstract class AbstractController
{
    private $globalVariables;

    public function setGlobalVariables(array $globalVariables)
    {
        $this->globalVariables = $globalVariables;
    }

    protected function render(string $view, array $data = []): Response
    {
        $response = new Response();
        if ($this->viewExists($view)) {
            $htmlContent = $this->renderView($view, $data);
            $response->setStatusCode(200);
            $response->setContent($htmlContent);
        } else {
            $response->setStatusCode(500);
            $response->setContent("ERROR: The view <strong>$view</strong> doesn't exist.");
        }
        return $response;
    }

    protected function redirect(string $url, int $status = 302): Response
    {
        $redirectingResponse = new Response();
        $redirectingResponse->setStatusCode($status);
        $redirectingResponse->setHeaders(array("Location", $url));
        return $redirectingResponse;
    }

    protected function redirectToRoute(string $route, array $parameters = [], int $status = 302): Response
    {
        return $this->redirect($this->generateUrl($route, $parameters), $status);
    }

    protected function generateUrl(string $route, array $parameters = []): string
    {
        $ret = $route;
        $routes = Kernel::getCurrent()->getRoutes();
        // TODO: Improve to manage parameters inside path, e.g: /search/{query}
        if (array_key_exists($route, $routes)) {
            $ret = '?' . http_build_query($parameters);
        }
        return $ret;
    }

    private function viewExists(string $view): bool
    {
        return file_exists($this->getViewFullpath($view));
    }

    protected function getViewFullpath(string $view): string
    {
        $templatesPath = Kernel::getProjectDir() . 'templates' . DIRECTORY_SEPARATOR;
        return $templatesPath . $view;
    }

    public function renderView(string $view, array $data)
    {
        foreach ($this->globalVariables as $key => $value) {
            ${$key} = $value;
        }
        foreach ($data as $key => $value) {
            ${$key} = $value;
        }
        $tpPath = $this->getViewFullpath("");
        ob_start();
        $phpCodeFromView = file_get_contents($this->getViewFullpath($view));

        // include
        $callback = new MyIncludeCallback($data, $this);
        $phpCodeFromView = preg_replace_callback(
            '/{%(\s*)include(\s*)(\S+)(\s*)%}/',
            array($callback, 'callback'),
            $phpCodeFromView
        );
        // echo variable
        $phpCodeFromView = preg_replace('/{{(\s*)(\w*)(\s*)}}/', "<?= $$2 ?>", $phpCodeFromView, -1, $varReplacementCount);
        // echo function
        $phpCodeFromView = preg_replace('/{{(\s*)(.*)(\s*)}}/', "<?= $2 ?>", $phpCodeFromView);

        eval('?>' . $phpCodeFromView . '<?php ');
        $content = ob_get_clean();
        return $content;
    }
}

class MyIncludeCallback
{
    private $data;
    private $controller;

    function __construct($data, &$controller)
    {
        $this->data = $data;
        $this->controller = $controller;
    }

    public function callback($matches)
    {
        $viewName = $matches[3];
        $viewName = str_replace("'", '', $viewName);
        $viewName = str_replace('"', '', $viewName);
        return $this->controller->renderView($viewName, $this->data);
    }
}
