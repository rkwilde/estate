<?php
require_once 'model.php';

class HomeModel extends Model
{

  public $test = "Hello World!";

    public function __construct(){
        parent::__construct();
    }

}

?>
