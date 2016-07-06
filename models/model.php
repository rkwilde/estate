<?php

class Model
{
  public $db;
  public $person;
  public $loginRequired = false;
  public $pageToShow = '';
  public $errorMessage = ''; // Error Message to show
  public $message = ''; // General message to show

  public function __construct(){
      // connectToDatabase
      $this->db = connectToDatabase(DATABASE_SERVER, DATABASE_SCHEMA, DATABASE_USER, DATABASE_PASSWORD);

      // get session info

      // get person

      // require login if needed
      if($this->loginRequired && !$this->person){
        $_SESSION['pageToShowAfterLogin'] = request('page');
        $this->pageToShow = 'signin';
      }
  }
}

?>
