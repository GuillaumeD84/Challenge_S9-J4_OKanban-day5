<?php

class ListController
{

  // Création d'une nouvelle liste
  public function create()
  {
    $list = new ListModel();
    $list->setName($_POST['name']);

    $list->save();

    echo json_encode([
      'id' => $list->getId(),
      'name' => $list->getName()
    ]);
  }

  // Modification d'une liste existante
  public function update()
  {
    $list = ListModel::find($_POST['id']);
    $list->setName($_POST['name']);

    $list->save();

    echo json_encode([
      'id' => $list->getId(),
      'name' => $list->getName()
    ]);
  }

  // Enregistre les positions de tous
  // les post-it dans chaque liste
  public function sort()
  {
    var_dump($_POST);
    foreach ($_POST as $listId => $cards) {
      // On recherche la liste à modifier
      $list = ListModel::find($listId);
      var_dump($list);
      // On transmet les informations de l'ordre
      // de chaque post-it à la méthode d'enregistrement
      $list->sort($cards);
    }
  }

  // Suppression d'une liste existante
  public function delete($params)
  {
    // Id de la liste à supprimer = $params['id']
    echo $params['id'].' : LIST/DELETE';
  }
}
