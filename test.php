<?php
ini_set('display_errors', 1);
?>
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
  <h1><a href="test.php">Test</a></h1>

<?php
require_once 'config.php';
require_once 'library/db_library.php';

$db = connectToDatabase(DATABASE_SERVER, DATABASE_SCHEMA, DATABASE_USER, DATABASE_PASSWORD);

$insert_test = isset($_REQUEST['insert_test'])? $_REQUEST['insert_test']: 0;

if($insert_test){
  echo 'prepare to insert 1 row ('.$insert_test.')'.'<br>';
  $test = "Test ".date('H:i:s'). " Eric's Test";
  $stmt = $db->prepare("INSERT INTO test(test) VALUES (:test)");
  $stmt->bindParam(':test', $test, PDO::PARAM_STR, 100).'<br>';
  if ($stmt->execute()) {
    echo '1 row has been inserted <br>';
    $test_id = $db->lastInsertId();
    echo "test id = $test_id<br>";
  }
}

foreach($db->query('select * from test') as $row) {
    echo $row['test_id'].': '.$row['test']."<br>\n";
}

?>

<a href="test.php?insert_test=1">Insert Test Record</a><br>

</body>
</html>
