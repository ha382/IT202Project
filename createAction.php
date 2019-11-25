<?php
require('config.php');
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
$db = new PDO($conn_string, $username, $password);


if(isset($_POST['Lusername'])){
  $enteredUsername = $_POST['Lusername'];
}
if(isset($_POST['Lpassword'])){
  $enteredPassword = $_POST['Lpassword'];
}
if(isset($_POST['CtableName'])){
  $enteredTableName = $_POST['CtableName'];

}

$stmt = $db->query("SELECT * FROM TestUsers where username = '$enteredUsername'");
$result = $stmt->fetch();

//HASH THE ENTERED PASSWORD AND COMPARE TO LOGIN
$hashed = hash('sha512', $enteredPassword);
if($result['username'] == $enteredUsername && strlen($enteredUsername) > 0 && $result['password'] == $hashed){ 
  
  //ADD NAME OF TABLE IN A COLUMN
  $stmt = $db->query("UPDATE TestUsers SET tableName = '$enteredTableName' WHERE username = '$enteredUsername' AND password = '$hashed'"); 
  
  //PREFORMATS THE NAME OF THE TABLE TO BE CREATED
  $formattedTableName = $enteredUsername.$enteredTableName;
  //QUERY TO CREATE A SPECIFIED TABLE
  $createQuery = "CREATE TABLE $formattedTableName (username VARCHAR(16), score INT(16) )";
  $db->exec($createQuery);
  
  
  header("Location: createSuccess.html");
} else {
  echo "Login Failed<br><br>";
  header("Location: loggedIndex.html#create");
}



?>