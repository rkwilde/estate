<?php
require_once 'ViewPage.php';

class HomeView extends ViewPage
{
    private $model;
    private $controller;
    public $html = 'HomeView.phtml';

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

}

?>
