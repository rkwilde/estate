<?php
ini_set('display_errors', 1);
session_start();

require_once 'config.php';
require_once 'constants.php';
require_once 'library/standard_library.php';
require_once 'library/db_library.php';

/*  
- request function returns GET or POST value matching first argument, 
  or the second argument ('' by default) if it doesn't exist.
- Value of page should be one of the keys in $data, as defined below. 
*/ 
$page = request('page', 'home'); 
//ppr($_SERVER, "Server");
//ppr($_SESSION, "Session");


// Find out what page has been requested (all routed through index.php?page=whatever)
while ($page) {
  // define sets of MVC classes corresponding to each page
  $data = array(
      'home' => array('model' => 'HomeModel', 'view' => 'HomeView', 'controller' => 'HomeController')
      , 'signup' => array('model' => 'SignUpModel', 'view' => 'SignUpView', 'controller' => 'SignUpController')
      , 'signin' => array('model' => 'SignInModel', 'view' => 'SignInView', 'controller' => 'SignInController')
      , 'main' => array('model' => 'MainModel', 'view' => 'MainView', 'controller' => 'MainController')
  );

  // $mvc holds array of MVC classes. Default is (HomeModel, HomeView, HomeController).
  if (isset($data[$page])) {
    $mvc = $data[$page];
  } else {
    $mvc = $data['home'];
  }

  // bring in files for selected MVC classes
  require_once("models/{$mvc['model']}.php");
  require_once("controllers/{$mvc['controller']}.php");
  require_once("views/{$mvc['view']}.php");

  // construct model and controller
  $m = new $mvc['model']();
  $c = new $mvc['controller']($m);
  $page = $m->pageToShow;     // should be blank unless follow-up redirection required. 
}

// construct view, now that page to show to user is decided on
$v = new $mvc['view']($c, $m);
$v->display();    // includes header and footer with corresponding phtml file in between

?>
