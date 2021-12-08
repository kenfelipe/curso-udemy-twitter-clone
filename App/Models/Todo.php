<?php

namespace App\Models;

use MF\Model\Model;

class Todo extends Model {

  public function getTodos() {
    $query = 'SELECT todo FROM todos';

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function getInfos() {
    $query = '
      SELECT todos.id, todos.todo, state.description as state
      FROM todos LEFT JOIN state on (todos.state = state.state)
    ';

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }
}

?>