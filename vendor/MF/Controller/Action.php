<?php
namespace MF\Controller;

abstract class Action {

  protected $view;

  public function __construct() {
    $this->view = new \stdClass();
  }

  protected function render($layout, $page) {
    $this->view->page = $page;

    $layout_path = "../App/Views/{$layout}.phtml";
    require_once $layout_path;
  }

  protected function content() {
    $className = get_class($this);
    $className = str_replace('App\\Controllers\\', '', $className);
    $className = str_replace('Controller', '', $className);

    $filepath =  "../App/Views/{$className}/{$this->view->page}.phtml";

    require_once $filepath;
  }
}

?>