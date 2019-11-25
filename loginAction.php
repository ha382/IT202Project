<?php
require('config.php');
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
$db = new PDO($conn_string, $username, $password);

//CHECK IF 'Lname' EXISTS
if($_POST['Lusername']){
  $enteredUsername = $_POST['Lusername'];
}
//CHECK IF 'Lpassword' EXISTS
if($_POST['Lpassword']){
  $enteredPassword = $_POST['Lpassword'];
}

//QUERIES TO SELECT EVERY FIELD FROM 'TestUsers'
$stmt = $db->query("SELECT * FROM TestUsers where username = '$enteredUsername'");
$result = $stmt->fetch();

//HASH THE ENTERED PASSWORD AND COMPARE TO LOGIN
$hashed = hash('sha512', $enteredPassword);
//CHECKS IF THE USERNAME AND PASSWORD MATCH AN ENTRY IN THE DATABASE; ALSO CHECKS IF THE PASSWORD ENTERED IS NOT AN EMPTY STRING
if($result['username'] == $enteredUsername && strlen($enteredUsername) > 0 && $result['password'] == $hashed){
  //REDIRECTS TO LOGGED-IN DASHBOARD
  header("Location: loggedIndex.html");
} else {
  //REDIRECTS BACK TO LOGIN PAGE
  header("Location: index.html#login");
}



?>