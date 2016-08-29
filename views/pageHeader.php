<!DOCTYPE html>
<html lang="en">
<head>
  <title>Estate</title>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/styles.css">
	<script src="javascript/jquery-3.0.0.min.js"></script>
	<script src="javascript/script.js"></script>
</head>
<body>
<div class="header">
  <img class="logo" src="images/logo.png" alt="company logo">
  <div class="loginArea">
    <a class="loginButton" href="index.php?page=signin">Login</a>
    <a class="signUpButton" href="index.php?page=signup">Sign Up</a>
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
