<?php

function connectToDatabase($dbServer, $dbSchema, $dbUser, $dbPassword){
  return new PDO("mysql:host={$dbServer};dbname={$dbSchema}", $dbUser, $dbPassword);
}

function getPersonByLoginAndPassword($db, $login, $pass_word){
  /*
  if($insert_test){
    $test = "Test ".date('H:i:s'). " Eric's Test";
    $stmt = $db->prepare("INSERT INTO test(test) VALUES (:test)");
    $stmt->bindParam(':test', $test, PDO::PARAM_STR, 100);
    if ($stmt->execute()) {
      echo '1 row has been inserted';
      $test_id = $db->lastInsertId();
      echo "test id = $test_id<br>";
    }
  }


  */

  //foreach($db->query('select * from test') as $row) {
  //    echo $row['test_id'].': '.$row['test']."<br>\n";
  //}

  /*
  $stmt = $db->prepare("SELECT * FROM person WHERE login=? AND pass_word=password(?)");
  $stmt->execute(array($login, $pass_word));
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ppr($rows, "Rows");
  */

  /*
  $sql = "
    select *
    from person
    where login = '".addslashes($login)."'
    and pass_word = password('".addslashes($login)."')
    and active = 1
  ";
  echo "Flag a<br>";
  foreach($db->query($sql) as $row) {
      echo "X: ".$row['person_id'].': '.$row['first_name']."<br>\n";
  }
  */
  //$sql = "select * from person where person_id = 1";
  //$stmt = $db->prepare($sql);
  //$stmt->bindParam(':login', $login, PDO::PARAM_STR, 100);
  //$stmt->bindParam(':pass_word', $pass_word, PDO::PARAM_STR, 100);
  //return $db->query($sql);
  return array();
}

?>
