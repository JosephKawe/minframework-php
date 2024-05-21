<?php

namespace MF\Init;

abstract class Bootstrap {
    private $routes;

    abstract protected function initRoutes();

    public function __construct() {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    public function getRoutes() {
        return $this->routes;
    }

    public function setRoutes(array $routes) {
        $this->routes = $routes;
    }

    protected function run($url) {
        foreach ($this->getRoutes() as $key => $route) {
            if ($url == $route['route']) {
                $class = "App\\Controllers\\" . ucfirst($route['controller']);
                $controller = new $class;
                $action = $route['action'];
                $controller->$action();
                return; // Termina o loop ao encontrar a rota correspondente
            }
        }
        // Pode adicionar um tratamento de erro ou redirecionamento se a rota não for encontrada
    }

    protected function getUrl() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}