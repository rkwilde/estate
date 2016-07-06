<?php
require_once 'view.php';

class ViewPage extends View
{
    public $model;
    public $controller;

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output() {
        return '<p><a href="mvc.php?action=clicked"' . $this->model->string . "</a></p>";
    }

    public function display() {
      include 'pageHeader.php';
      include $this->html;
      include 'pageFooter.php';
    }
}

?>
