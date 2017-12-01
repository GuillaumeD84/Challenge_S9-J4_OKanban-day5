<?php

class Database
{
  // Handler de gestion de connexion
  static function getDB()
  {
    // Connexion à la bdd
    try {
      $connection = new PDO(
        "mysql:host=localhost;dbname=okanban;charset=utf8",
        'okanbanmaster',
        'project_okanban',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
      );

      return $connection;
    }
    catch (PDOException $e) {
      die('Erreur de connexion à la base de donnée : '.$e->getMessage());
    }

  }
}
