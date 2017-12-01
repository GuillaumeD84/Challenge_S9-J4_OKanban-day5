<?php

class CardController
{

  // Création d'une nouvelle carte
  public function create()
  {
    $card = new CardModel();
    $card->setTitle($_POST['title']);
    $card->setOrdering($_POST['ordering']);
    $card->setListId($_POST['list_id']);

    $card->save();

    echo json_encode([
      'id' => $card->getId(),
      'title' => $card->getTitle(),
      'ordering' => $card->getOrdering(),
      'list_id' => $card->getListId()
    ]);
  }

  // Modification d'une carte existante
  public function update()
  {
    $card = CardModel::find($_POST['id']);
    $card->setTitle($_POST['title']);

    $card->save();

    echo json_encode([
      'id' => $card->getId(),
      'title' => $card->getTitle(),
      'ordering' => $card->getOrdering(),
      'list_id' => $card->getListId()
    ]);
  }

}
