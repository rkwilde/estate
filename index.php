<?php
ini_set('display_errors', 1);
session_start();

require_once 'config.php';
require_once 'constants.php';
require_once 'library/standard_library.php';
require_once 'library/db_library.php';

$page = request('page', 'home');
//ppr($_SERVER, "Server");
//ppr($_SESSION, "Session");

while ($page) {
  $data = array(
      'home' => array('model' => 'HomeModel', 'view' => 'HomeView', 'controller' => 'HomeController')
      , 'signup' => array('model' => 'SignUpModel', 'view' => 'SignUpView', 'controller' => 'SignUpController')
      , 'signin' => array('model' => 'SignInModel', 'view' => 'SignInView', 'controller' => 'SignInController')
      , 'main' => array('model' => 'MainModel', 'view' => 'MainView', 'controller' => 'MainController')
  );

  if (isset($data[$page])) {
    $mvc = $data[$page];
  } else {
    $mvc = $data['home'];
  }

  require_once("models/{$mvc['model']}.php");
  require_once("controllers/{$mvc['controller']}.php");
  require_once("views/{$mvc['view']}.php");

  $m = new $mvc['model']();
  $page = $m->pageToShow;
}

$c = new $mvc['controller']($m);
$v = new $mvc['view']($c, $m);
$v->display();

?>
