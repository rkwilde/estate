<?php
require_once 'controller.php';

class SignInController extends Controller
{

    public function __construct($model){
        parent::__construct($model);
        
        // if already signed in, go to main
        if ($this->model->isSignedIn()) {
          $this->model->pageToShow = 'main';
        }
        
        // if form has been submitted, try to log in. Create error messages if needed. (error displayed in the header)       
        if(request('submitSignIn')){
          $login = request('login');
          $pass_word = request('pass_word');
          if(!$login){
            $this->model->errorMessage = "Please enter your email.";
          } else if (!$pass_word){
            $this->model->errorMessage = "Please enter your password.";
          }
          if(!$this->model->errorMessage){
            $this->model->login($login, $pass_word);
          }
        }
    }

}

?>
