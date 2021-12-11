<?php

namespace App\Controllers;

// MF frame
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

  public function index() {
    $this->render('index');
  }

  public function subscribe() {
    $this->render('subscribe');
  }

  public function registered() {
    $this->render('registered');
  }
}

?>