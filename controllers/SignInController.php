<?php
require_once 'controller.php';

class SignInController extends Controller
{

    public function __construct($model){
        parent::__construct($model);

        if(request('submitSignIn')){
          $login = request('login');
          $pass_word = request('pass_word');
          if(!$login){
            $this->model->errorMessage = "Please enter your email.";
          } else if (!$pass_word){
            $this->model->errorMessage = "Please enter your password.";
          }
          if(!$this->model->errorMessage){
            $this->login($login, $pass_word);
          }
        }
    }

    public function login($login, $pass_word) {
      echo "function login($login, $pass_word)<br>";
      $person = getPersonByLoginAndPassword($this->model->db, $login, $pass_word);
      ppr($person, "Person");
      //echo "Name = {$person->first_name}<br>\n";
    }
}

?>
