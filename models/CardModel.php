<?php

class CardModel
{
  private $id;
  private $title;
  private $ordering;
  private $list_id;

  // Active record
  public function save()
  {
    $db = Database::getDB();

    // On créé la requête d'ajout/modification
    $sql = 'REPLACE INTO `cards` (id, title, ordering, list_id) VALUES (:id, :title, :ordering, :list_id)';

    // On prépare la requête
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
    $statement->bindValue(':title', $this->title, PDO::PARAM_STR);
    $statement->bindValue(':ordering', $this->ordering, PDO::PARAM_INT);
    $statement->bindValue(':list_id', $this->list_id, PDO::PARAM_INT);

    // On éxécute la requête
    $statement->execute();

    $this->id = $db->lastInsertId();
  }

  // Récupère une carte en base via son id
  static function find($id)
  {
    // On établit la connexion avec la database
    $db = Database::getDB();

    // La requête à éxécuter
    $sql = 'SELECT * FROM `cards` WHERE id = :id';

    // On prépare la requête
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // On éxécute la requête
    $statement->execute();

    return $statement->fetchObject('CardModel');
  }

  // GETTER $id
  public function getId()
  {
    return $this->id;
  }

  // GETTER $title
  public function getTitle()
  {
    return ucfirst($this->title);
  }

  // GETTER $ordering
  public function getOrdering()
  {
    return $this->ordering;
  }

  // GETTER $list_id
  public function getListId()
  {
    return $this->list_id;
  }

  // SETTER $id
  public function setId($id)
  {
    $this->id = $id;
  }

  // SETTER $title
  public function setTitle($title)
  {
    $this->title = $title;
  }

  // SETTER $ordering
  public function setOrdering($ordering)
  {
    $this->ordering = $ordering;
  }

  // SETTER $list_id
  public function setListId($list_id)
  {
    $this->list_id = $list_id;
  }
}
