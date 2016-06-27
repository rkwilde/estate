<?php

function connectToDatabase($dbServer, $dbSchema, $dbUser, $dbPassword){
  return new PDO("mysql:host={$dbServer};dbname={$dbSchema}", $dbUser, $dbPassword);
}

?>
