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
  <div>Page Header</div>
  <a href="index.php?page=home">Home</a>
  <a href="index.php?page=signup">Sign Up</a>
  <a href="index.php?page=signin">Sign In</a>
  <a href="index.php?page=main">Main</a>
</div>
<?php
if($this->model->errorMessage){
  echo "<div id='errorMessage'>".$this->model->errorMessage."</div>";
}
if($this->model->message){
  echo "<div id='message'>".$this->model->message."</div>";
}
?>
