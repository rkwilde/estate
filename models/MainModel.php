<?php
require_once 'model.php';

class MainModel extends Model
{

    public function __construct(){
      $this->loginRequired = true;
      parent::__construct();
    }

}

?>
