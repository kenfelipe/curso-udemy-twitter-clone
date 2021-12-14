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
    $this->view->tweetsCount = $tweet->getMyTweetsCount($_SESSION['id']);

    $following = Container::getModel('Following');

    $this->view->followCount = $following->getMyFollowCount($_SESSION['id']);
    $this->view->followerCount = $following->getMyFollowerCount($_SESSION['id']);

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

  public function remove() {
    $this->authorization();

    $tweet = Container::getModel('Tweet');
    $tweet->remove($_POST['tweet_id']);

    header('Location: /timeline');
  }
  
  public function following() {
    $this->authorization();

    $this->view->search_result = array();

    $this->render('following');
  }

  public function search_follow() {
    $this->authorization();

    $user = Container::getModel('User');

    if(!empty($_POST['search_string'])) {
      $result = $user->search($_POST['search_string'], $_SESSION['id']);

      $this->view->search_result = $result;

    } else {
      $this->view->search_result = array();
    }

    $this->render('following');
  }

  public function follow() {
    $this->authorization();

    $following = Container::getModel('Following');

    $following->follow($_SESSION['id'], $_GET['target_id']);

    header('Location: /following');
  }

  public function unfollow() {
    $this->authorization();

    $following = Container::getModel('Following');

    $following->unfollow($_SESSION['id'], $_GET['target_id']);

    header('Location: /following');
  }
}

?>
