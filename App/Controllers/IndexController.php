<?php

namespace App\Controllers;

// MF frame
use MF\Controller\Action;
use MF\Model\Container;

// Model
use App\Model\Todo;

class IndexController extends Action {

  public function index() {
    $todos = Container::getModel('Todo');
    $data = $todos->getTodos();

    $this->view->data = $data;

    $this->render('layout', 'index');
  }

  public function about() {
    $todos = Container::getModel('Todo');
    $data = $todos->getInfos();

    $this->view->data = $data;

    $this->render('layout_2', 'about');
  }
}

?>