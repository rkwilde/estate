<?php

class Model
{
  public $db;
  public $person;
  public $loginRequired = false;
  public $pageToShow = '';

  public function __construct(){
      // connectToDatabase
      $this->db = connectToDatabase(DATABASE_SERVER, DATABASE_SCHEMA, DATABASE_USER, DATABASE_PASSWORD);

      // get session info

      // get person

      // require login if needed
      if($this->loginRequired && !$this->person){
        $this->pageToShow = 'signin';
      }
  }
}

?>
