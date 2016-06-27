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
  <h1>Test</h1>

<?php
require_once 'config.php';
require_once 'library/db_library.php';

$db = connectToDatabase(DATABASE_SERVER, DATABASE_SCHEMA, DATABASE_USER, DATABASE_PASSWORD);

foreach($db->query('select * from test') as $row) {
    echo $row['test_id'].': '.$row['test']."<br>\n";
}

/*
$test = "Test ".date('H:i:s');
$stmt = $db->prepare("INSERT INTO test(test) VALUES (:test)");
$stmt->bindParam(':test', $test, PDO::PARAM_STR, 100);
if ($stmt->execute()) {
  echo '1 row has been inserted';
  $test_id = $db->lastInsertId();
  echo "test id = $test_id<br>";
}
*/

echo "Done<br>\n";

?>

</body>
</html>