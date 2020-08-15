<?php
namespace App;

class Router
{
    private $routes;
    private $controllerName = 'SiteController';
    private $actionName = '';
    private $params = [];
    private $controllerNamespace = 'App';

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    public function getController()
    {
        return "{$this->controllerNamespace}\\{$this->controllerName}";
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParams()
    {
        return $this->params;
    }

    private function getURI ()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function parse ()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $item) {
            if (preg_match("~$uriPattern~", $uri)) {
                $path = $item['path'];

                if (isset($item['namespace'])) {
                    $this->controllerNamespace = $item['namespace'];
                }

                $internalRoute = preg_replace(
                    "~$uriPattern~", $path, $uri
                );

                $segments = explode('/', $internalRoute);

                $this->controllerName = ucfirst(
                    array_shift($segments).'Controller'
                );

                $this->actionName = 'action'.ucfirst(
                    array_shift($segments)
                );

                $this->params = $segments;
            }
        }
    }
}