<?php

namespace App;

class Connection {
  public static function getDB() {
    $dsn = 'mysql:host=localhost;dbname=udemy_app_lista_tarefas;charset=utf8';
    $user = 'root';
    $pass = '';

    try {
      $conn = new \PDO($dsn, $user, $pass);

      return $conn;

    } catch (\PDOException $e) {
      echo 'db connection error: ' . $e->getMessage();
      exit();
    }
  }
}
?>