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
      'login' => [
        'route' => '/login',
        'controller' => 'AuthController',
        'action' => 'login',
      ],
      'logout' => [
        'route' => '/logout',
        'controller' => 'AuthController',
        'action' => 'logout',
      ],
      'timeline' => [
        'route' => '/timeline',
        'controller' => 'AppController',
        'action' => 'timeline',
      ],
      'tweet' => [
        'route' => '/tweet',
        'controller' => 'AppController',
        'action' => 'tweet',
      ],
    ];

    $this->setRoutes($routes);
  }
}

?>