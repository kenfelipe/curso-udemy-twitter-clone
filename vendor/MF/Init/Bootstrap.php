<?php

namespace MF\Init;

abstract class Bootstrap {

  protected $routes = 'private';

  abstract protected function initRoutes();

  public function __construct() {
    $this->initRoutes();
    $this->run($this->getUrl());
  }

  protected function setRoutes(array $routes) {
    $this->routes = $routes;
  }

  private function run($url) {
    foreach($this->routes as $key => $route) {
      if($route['route'] === $url) {
        $class = "App\\Controllers\\{$route['controller']}";
        $action = $route['action'];

        $controller = new $class();
        $controller->$action();
      }
    }
  }

  private function getUrl() {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }
}

?>