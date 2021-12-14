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

  public function retriveTweets($user_id) {
    $query = "
      SELECT 
        tweets.id, users.name, tweets.tweet, 
        DATE_FORMAT(tweets.tweet_date, '%d/%m/%Y %H:%i') as tweet_date
      FROM 
        tweets 
        LEFT JOIN users on (tweets.user_id = users.id)
      WHERE 
        users.id = :user_id 
        OR
        tweets.user_id IN (
          SELECT following.follow_id
          FROM following
          WHERE following.user_id = :user_id
        )
      ORDER BY
        tweets.tweet_date DESC
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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