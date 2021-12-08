<?php

namespace MF\Model;

use App\Connection;

class Container {

  public static function getModel($model) {
    $class = "App\\Models\\{$model}";
    $conn = Connection::getDb();

    return new $class($conn);
  }
}

?>