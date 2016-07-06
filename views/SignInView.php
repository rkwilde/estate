<?php
require_once 'ViewPage.php';

class SignInView extends ViewPage
{
    public $html = 'SignInView.phtml';

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

}

?>
