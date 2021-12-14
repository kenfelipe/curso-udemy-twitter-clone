<?php

namespace App\Models;

use MF\Model\Model;

class Following extends Model {
  private $id;
  private $user_id;
  private $follow_id;

  public function follow($user_id, $target_id) {
    $query = '
      INSERT INTO following (user_id, follow_id)
      VALUES (:user_id, :target_id)
    ';
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':target_id', $target_id);
    $stmt->execute();
  }

  public function unfollow($user_id, $target_id) {
    $query = '
      DELETE FROM following
      WHERE user_id = :user_id AND follow_id = :target_id
    ';

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':target_id', $target_id);
    $stmt->execute();
  }

  public function getMyFollowCount($user_id) {
    $query = '
      SELECT Count(*) as follow_count
      FROM following
      WHERE user_id = :user_id
    ';
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    
    return $stmt->fetch(\PDO::FETCH_ASSOC)['follow_count'];
  }

  public function getMyFollowerCount($user_id) {
    $query = '
      SELECT Count(*) as follower_count
      FROM following 
      WHERE follow_id = :user_id
    ';
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    
    return $stmt->fetch(\PDO::FETCH_ASSOC)['follower_count'];
  }
}

?>