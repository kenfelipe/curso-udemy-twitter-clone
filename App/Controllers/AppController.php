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
}

?>
