<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

  public function authorization() {
    session_start();

    $emptyId = empty($_SESSION['id']);
    $emptyName = empty($_SESSION['name']);
    $emptyEmail = empty($_SESSION['email']);

    if($emptyId || $emptyName || $emptyEmail) {
      header('Location: /');
    }
  }

  public function timeline() {
    $this->authorization();

    $this->render('timeline');
  }

  public function tweet() {
    $this->authorization();

    $tweet = Container::getModel('Tweet');

    $tweet->__set('user_id', $_SESSION['id']);
    $tweet->__set('tweet', $_POST['tweet']);

    if($tweet->validation()) {
      $tweet->tweet();
    }

    header('Location: /timeline');
  }
}

?>
