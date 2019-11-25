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
  
  /*
  $stmt = $db->query("UPDATE TestUsers SET tableName = '$enteredTableName' WHERE username = '$enteredUsername' AND password = '$hashed'"); 
  $sql = "CREATE TABLE '$enteredUsername'.'$enteredTableName' (id INT(6) UBSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(16) NOT NULL, score INT(16) NOT NULL))";
  */
  
  
  header("Location: createSuccess.html");
} else {
  echo "Login Failed<br><br>";
  header("Location: loggedIndex.html#create");
}



?>