<?php

namespace App\Controllers;

// MF frame
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

  public function index() {
    $this->render('layout', 'index');
  }

  public function subscribe() {
    $this->render('layout', 'subscribe');
  }
}

?>