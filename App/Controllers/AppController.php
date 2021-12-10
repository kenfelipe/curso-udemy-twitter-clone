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

    $tweet = Container::getModel('Tweet');

    $this->view->tweets = $tweet->retriveTweets($_SESSION['id']);

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
  
  public function following() {
    $this->authorization();

    $this->render('following');
  }

  public function search_follow() {
    $this->authorization();

    $user = Container::getModel('User');

    $result = $user->search($_POST['search_string']);

    $this->view->search_result = $result;

    $this->render('following');
    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';
  }
}

?>
