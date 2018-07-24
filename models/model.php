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

      // log out if requested by user
      if(request('signout')==1) {
        $_SESSION['signedIn'] = 0; 
        $this->message = 'You have been successfully signed out.';
        // not sure if I need to clear out other info too, like $_SESSION['userID'], 
        // or if I should use it to pre-populate the username/email field
      }

      // if signed in, get person info from database via ID saved in session
      if($this->isSignedIn()) {
        $this->person = getPersonByID($this->db,$_SESSION['userID']);
      } elseif ($this->loginRequired) {   // require login if needed
          $_SESSION['pageToShowAfterLogin'] = request('page');
          $this->pageToShow = 'signin';
      }
  }
  
  public function login($login, $pass_word) {
    if($this->person = getPersonByLoginAndPassword($this->db, $login, $pass_word)) {
      $_SESSION['signedIn']=1;
      $_SESSION['userID']=$this->getUserID();
      /*now that you're logged in, go to the main page 
        (or to pageToShowAfterLogin, the page you wanted in the first place and got redirected to the login screen from)*/
      if(isset($_SESSION['pageToShowAfterLogin'])) {
        $this->pageToShow = $_SESSION['pageToShowAfterLogin'];
      } else {
        $this->pageToShow = 'main';
      }
    }
  }
  
  public function signUp($fname,$lname,$login,$email,$pass_word) {
    /* ppr("$fname,$lname,$login,$email,$pass_word"); */
    $report_message = newPerson($this->db,$fname,$lname,$login,$email,$pass_word);
    if ($report_message == "Success.") {
      /* $this->message = "You have been successfully signed up."; */ 
        /* message wasn't used because signed-up user is redirected to main, re-instantiating the model */
      return true;
    } else {
      $this->errorMessage = $report_message;
      return false;
    }
  }
  
  public function getFirstName(){
    // sanitize for html/js hacks?
    if(!$this->person) return "errorNotLoggedIn";
    return $this->person[0]['first_name'];
  }
  
  public function getLastName(){
    // sanitize for html/js hacks?
    if(!$this->person) return "errorNotLoggedIn";
    return $this->person[0]['last_name'];
  }
  
  public function getUserID() {
    if(!$this->person) return NULL;
    return $this->person[0]['person_id'];
  }
  
  public function isSignedIn() {
      return (isset($_SESSION['signedIn']) && isset($_SESSION['userID']) && $_SESSION['signedIn']==1);
  }
  
}

?>
