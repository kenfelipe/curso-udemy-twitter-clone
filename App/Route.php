<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

  protected function initRoutes() {
    $routes = [
      'index' => [
        'route' => '/',
        'controller' => 'IndexController',
        'action' => 'index',
      ],
      'subscribe' => [
        'route' => '/subscribe',
        'controller' => 'IndexController',
        'action' => 'subscribe',
      ],
      'register' => [
        'route' => '/register',
        'controller' => 'AuthController',
        'action' => 'register',
      ],
    ];

    $this->setRoutes($routes);
  }
}

?>