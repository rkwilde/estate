<?php
require_once 'ViewPage.php';

class HomeView extends ViewPage
{
    public $html = 'HomeView.phtml'; #display function of ViewPage says to include $html, so this file will have the home view elements

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;

    }

}

?>
