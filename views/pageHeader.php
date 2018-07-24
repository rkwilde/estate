<!DOCTYPE html>
<html lang="en">
<!-- pageHeader.php -->
<head>
  <title>Estate</title>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/styles.css">
	<script src="javascript/jquery-3.0.0.min.js"></script>
	<script src="javascript/script.js"></script>
</head>
<body>
<a name="top"></a>
<div class="header">
  <a href="index.php"><img class="logo" src="images/logo.png" alt="company logo"></a>
  <div class="loginArea">
    <?php // loginArea buttons should display Login and Sign Up if not signed in, or Logout and Account if signed in.  
    if(isset($_SESSION['signedIn']) && $_SESSION['signedIn']==1) {
      echo
       '<a class="loginButton" href="index.php?page=signin&signout=1">Logout</a>
        <a class="signUpButton" href="index.php?page=main">Account</a>';
    } else {
      echo
       '<a class="loginButton" href="index.php?page=signin">Login</a>
        <a class="signUpButton" href="index.php?page=signup">Sign Up</a>';	
    }
    ?>
  </div>
  <div class="menu">
    <a href="index.php#howItWorks">How It Works</a>
    <a href="index.php#pricing">Pricing</a>
    <a href="index.php#features">Features</a>
  </div>
</div>
<?php
if($this->model->errorMessage){
  echo "<div id='errorMessage'>".$this->model->errorMessage."</div>";
}
if($this->model->message){
  echo "<div id='message'>".$this->model->message."</div>";
}
?>
<!-- end of pageHeader.php -->
