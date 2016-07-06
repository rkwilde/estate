<?php
require_once 'ViewPage.php';

class MainView extends ViewPage
{
    public $html = 'MainView.phtml';

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

}

?>
