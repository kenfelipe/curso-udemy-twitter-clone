<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

  public function register() {
    $user = Container::getModel('User');

    $user->__set('name', $_POST['name']);
    $user->__set('email', $_POST['email']);
    $user->__set('password', $_POST['password']);

    if($user->validator()) {
      $user->register();
      header('Location: /');
    } else {
      header('Location: /subscribe?register=error');
    }
  }
}

?>