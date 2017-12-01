<?php

class PagesController
{
  private $router;

  public function __construct($router)
  {
    $this->router = $router;
  }

  // Affiche la page passée en paramètre ($template = STRING)
  private function render($template)
  {
    $alto = $this->router;

    require_once 'views/header.php';
    require_once 'views/'.$template.'.php';
    require_once 'views/footer.php';
  }

  // Affiche la page de contact
  public function contact()
  {
    $this->render('pages/contact');
  }

  // Affiche la page de contact
  public function contactValid()
  {
    var_dump($_POST);
    $this->render('pages/contactValid');
  }

  // Affiche les CGU
  public function cgu()
  {
    $this->render('pages/cgu');
  }
}
