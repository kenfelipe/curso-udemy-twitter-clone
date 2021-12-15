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

  public function retriveTweets($user_id) {
    $query = "
      SELECT 
        users.id as user_id, users.name, tweets.id, tweets.tweet, 
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

  public function retriveTweetsPerPage($user_id, $limit = 10, $offset = 0) {
    $query = "
      SELECT 
        users.id as user_id, users.name, tweets.id, tweets.tweet, 
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
      LIMIT
        :limit
      OFFSET
        :offset
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getTweetsCount($user_id) {
    $query = "
      SELECT 
        Count(*) as tweets_count
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
    
    return $stmt->fetch(\PDO::FETCH_ASSOC)['tweets_count'];
  }

  public function getMyTweetsCount($user_id) {
    $query = "
      SELECT 
        Count(*) as tweets_count
      FROM 
        tweets 
      WHERE 
        tweets.user_id = :user_id 
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    
    return $stmt->fetch(\PDO::FETCH_ASSOC)['tweets_count'];
  }

  public function remove($tweet_id) {
    $query = '
      DELETE FROM tweets
      WHERE tweets.id = :tweet_id
    ';
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':tweet_id', $tweet_id);
    $stmt->execute();
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}

?>