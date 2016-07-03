<?php
require_once 'ViewPage.php';

class SignUpView extends ViewPage
{
    private $model;
    private $controller;
    public $html = 'SignUpView.phtml';

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

}

?>
