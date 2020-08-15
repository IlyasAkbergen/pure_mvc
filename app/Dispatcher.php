<?php

namespace App;

class Dispatcher
{
    private $request;
    private $router;

    public function dispatch()
    {
        $this->request = new Request();
        $this->router = new Router();
        $this->router->parse();

        $controller = $this->loadController(
            $this->router->getController()
        );

        call_user_func_array(
            [$controller, $this->router->getActionName()],
            $this->router->getParams()
        );
    }

    public function loadController($controllerName)
    {
        return new $controllerName;
    }
}