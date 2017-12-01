<?php

class MainController
{
  // Affiche la page passée en paramètre ($template = STRING)
  private function render($template, $params)
  {
    require_once 'views/header.php';
    require_once 'views/'.$template.'.php';
    require_once 'views/footer.php';
  }

  // Affiche la page principale du site
  public function home()
  {
    // On récupère les listes
    $results = ListModel::findAll();

    // On affiche le template
    $this->render('home/content', $results);
  }

  // Affiche la page infos
  public function infos()
  {
    $this->render('home/infos');
  }

  public function test()
  {
    // $tablo = ['Guillaume', 'DURAND'];
    // echo json_encode($tablo);

    $tablo = ['prenom' => 'Guillaume', 'nom' => 'DURAND'];
    echo json_encode($tablo);
  }
}
