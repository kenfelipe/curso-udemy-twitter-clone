<?php

namespace App\Models;

use MF\Model\Model;

class User extends Model {
  private $id;
  private $name;
  private $password;
  private $email;

  public function __set($attr, $value) {
    $this->$attr = $value;
  }

  public function __get($attr) {
    return $this->$attr;
  }

  public function register() {
    $query = '
      INSERT INTO users (name, email, password) VALUES (:name, :email, :password)
    ';

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':name', $this->name);
    $stmt->bindValue(':email', $this->email);
    $stmt->bindValue(':password', $this->password);
    $stmt->execute();
  }

  public function existsUser() {
    $query = '
      SELECT *
      FROM users
      WHERE email = :email
    ';
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':email', $this->email);
    $stmt->execute();
    
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function validator() {
    $isset_name = !empty($this->name);
    $isset_email = !empty($this->email);
    $isset_password = !empty($this->password);

    return $isset_name && $isset_email && $isset_password;
  }
  
  public function login() {
    $query = '
      SELECT id, name, email
      FROM users
      WHERE email = :email AND password = :password
    ';
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':email', $this->email);
    $stmt->bindValue(':password', $this->password);
    $stmt->execute();
    
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function search($search_string, $user_id) {
    $query = "
      SELECT 
        u.id, 
        u.name,
        (
          SELECT count(*)
          FROM following as f
          WHERE 
            f.user_id = :user_id AND 
            f.follow_id = u.id
        ) as already_followed
      FROM 
        users as u
      WHERE 
        u.name LIKE CONCAT('%', :search_string, '%') AND 
        u.id != :user_id
    ";
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':search_string', $search_string);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}

?>