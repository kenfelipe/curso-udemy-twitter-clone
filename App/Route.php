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
      'registered' => [
        'route' => '/registered',
        'controller' => 'IndexController',
        'action' => 'registered',
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
      'remove' => [
        'route' => '/remove',
        'controller' => 'AppController',
        'action' => 'remove',
      ],
      'following' => [
        'route' => '/following',
        'controller' => 'AppController',
        'action' => 'following',
      ],
      'search_follow' => [
        'route' => '/search_follow',
        'controller' => 'AppController',
        'action' => 'search_follow',
      ],
      'follow' => [
        'route' => '/follow',
        'controller' => 'AppController',
        'action' => 'follow',
      ],
      'unfollow' => [
        'route' => '/unfollow',
        'controller' => 'AppController',
        'action' => 'unfollow',
      ],
    ];

    $this->setRoutes($routes);
  }
}

?>