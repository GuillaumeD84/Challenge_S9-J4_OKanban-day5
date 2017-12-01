<?php

class ListModel
{
  private $id;
  private $name;

  // Active record
  public function save()
  {
    $db = Database::getDB();

    // On créé la requête d'ajout/modification
    $sql = 'REPLACE INTO `lists` (id, name) VALUES (:id, :name)';

    // On prépare la requête
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
    $statement->bindValue(':name', $this->name, PDO::PARAM_STR);

    // On éxécute la requête
    $statement->execute();

    $this->id = $db->lastInsertId();
  }

  // Fonction qui retourne tous les enregistrements
  static function findAll()
  {
    // On établit la connexion avec la database
    $db = Database::getDB();

    // La requête à éxécuter
    $sql = 'SELECT * FROM `lists`';

    // On éxécute la requête
    $result = $db->query($sql);

    // On récupère les résultats sous forme d'un objet
    // L'objet en question aura la forme de notre classe 'ListModel'
    return $result->fetchAll(PDO::FETCH_CLASS, 'ListModel');
  }

  // Récupère une liste en base via son id
  static function find($id)
  {
    // On établit la connexion avec la database
    $db = Database::getDB();

    // La requête à éxécuter
    $sql = 'SELECT * FROM `lists` WHERE id = :id';

    // On prépare la requête
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // On éxécute la requête
    $statement->execute();

    return $statement->fetchObject('ListModel');
  }

  public function getCards()
  {
    // On établit la connexion avec la database
    $db = Database::getDB();

    // La requête à éxécuter
    $sql = 'SELECT * FROM `cards` WHERE `list_id` = '.$this->id.' ORDER BY `ordering` ASC';

    // On éxécute la requête
    $result = $db->query($sql);

    // On récupère les résultats sous forme d'un objet
    // L'objet en question aura la forme de notre classe '???'
    // return $result->fetchAll(PDO::FETCH_CLASS, '???');
    return $result->fetchAll(PDO::FETCH_CLASS, 'CardModel');
  }

  // Sauvegarde l'ordre des post-it
  // dans cette liste
  public function sort($cards)
  {
    $db = Database::getDB();

    // $cards[cardId] = "position"
    foreach ($cards as $cardId => $position) {
      $sql = 'UPDATE cards SET list_id = :list_id, ordering = :order WHERE id = :card_id';
      $query = $db->prepare($sql);
      $query->bindValue(':list_id', $this->id);
      $query->bindParam(':order', $position);
      $query->bindParam(':card_id', $cardId);
      $query->execute();
    }
  }

  public function getLastCardOrder()
  {
    $db = Database::getDB();

    $sql = 'SELECT MAX(ordering) AS lastOrder FROM `cards` WHERE `list_id` = '.$this->id;

    $result = $db->query($sql);

    $result = $result->fetchAll(PDO::FETCH_NUM);

    return $result[0][0];
  }

  // GETTER $id
  public function getId()
  {
    return $this->id;
  }

  // GETTER $name
  public function getName()
  {
    return ucfirst($this->name);
  }

  // SETTER $id
  public function setId($id)
  {
    $this->id = $id;
  }

  // SETTER $name
  public function setName($name)
  {
    $this->name = $name;
  }
}
