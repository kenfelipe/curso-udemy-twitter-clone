<?php

namespace App\Models;

use MF\Model\Model;

class Tweet extends Model {
  private $id;
  private $user_id;
  private $tweet;
  private $tweet_date;

  public function __set($attr, $value) {
    $this->$attr = $value;
  }

  public function __get($attr) {
    return $this->$attr;
  }

  public function tweet() {
    $query = '
      INSERT INTO tweets (user_id, tweet)
      VALUES (:user_id, :tweet)
    ';
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $this->user_id);
    $stmt->bindValue(':tweet', $this->tweet);
    $stmt->execute();
  }

  public function validation() {
    return !empty($this->tweet);
  }
}

?>