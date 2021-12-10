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

  public function validator() {
    $setName = !empty($this->name);
    $setEmail = !empty($this->email);
    $setPassword = !empty($this->password);

    return $setName && $setEmail && $setPassword;
  }
}

?>