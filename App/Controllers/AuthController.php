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

    $valid = $user->validator();
    $exists = $user->existsUser();

    if($valid && !$exists) {
      $user->register();

      header('Location: /registered');

    } else {
      $error = $exists ? 'exists' : 'invalid';

      $name = "&name={$_POST['name']}";
      $email = "&email={$_POST['email']}";
      $password = "&password={$_POST['password']}";

      $placeholder = $name . $email . $password;

      header("Location: /subscribe?register={$error}" . $placeholder);
    }
  }

  public function login() {
    $user = Container::getModel('User');

    $user->__set('email', $_POST['email']);
    $user->__set('password', $_POST['password']);

    $userData = $user->login();

    if(!empty($userData)) {
      session_start();

      $_SESSION['id'] = $userData['id'];
      $_SESSION['name'] = $userData['name'];
      $_SESSION['email'] = $userData['email'];

      header('Location: /timeline');

    } else {
      header('Location: /?login=error');
    }
  }

  public function logout() {
    session_start();
    session_destroy();

    header('Location: /');
  }
}

?>