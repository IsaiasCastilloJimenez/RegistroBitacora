<?php

function conectarDB() : mysqli {
  $db = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'] ?? '',
    $_ENV['DB_BD']
      );
    $db->set_charset("utf8");
  
    if(!$db) {
        echo "Error, No se pudo conectar";
        exit;
    }
    return $db;
}
