<?php

class NotFoundController
{
  // Affiche la page passée en paramètre ($template = STRING)
  private function render($template)
  {
    require_once 'views/header.php';
    require_once 'views/'.$template.'.php';
    require_once 'views/footer.php';
  }

  // Affiche la page 404
  public function notFound()
  {
    $this->render('404/notFound');
  }
}
