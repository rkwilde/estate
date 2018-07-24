<?php
require_once 'controller.php';

class SignUpController extends Controller
{

    public function __construct($model){
        parent::__construct($model);
        
        // if already signed in, go to main
        if ($this->model->isSignedIn()) {
          $this->model->pageToShow = 'main';
        }
        
        
        // if form has been submitted, try to sign up. Create error messages if needed. (error displayed in the header)       
        if(request('submitSignUp')){
          $fname = request('fname');
          $lname = request('lname');
          $login = request('login');
          $email = request('email');
          $pass_word = request('pass_word');
          $redo_pass_word = request('redo_pass_word');
          if(!$fname || !$lname || !$login || !$email || !$pass_word || !$redo_pass_word){
            $this->model->errorMessage = "All fields required.";
          } else if ($pass_word != $redo_pass_word){
            $this->model->errorMessage = "Passwords do not match.";
          }
          if(!$this->model->errorMessage){
            if($this->model->signUp($fname,$lname,$login,$email,$pass_word)) {
              $this->model->login($login, $pass_word);
            }
          }
        }

    }
    
    public function clicked() {
    }
    
}

?>
