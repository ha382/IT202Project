<?php
require('config.php');
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
$db = new PDO($conn_string, $username, $password);

//QUERIES TO SELECT EVERY FIELD FROM 'TestUsers'
$stmt = $db->query("SELECT * from TestUsers");
$result = $stmt->fetch();

  $enteredUsername = $_POST['Rusername'];
  $enteredPassword = $_POST['Rpassword'];
  $enteredConfirmPassword = $_POST['RCpassword'];

//CHECK IF A USERNAME WAS ENTERED
if(strlen($enteredUsername) > 0 && isset($enteredUsername)){
  
} else {
  //REDIRECTS BACK TO REGISTER PAGE
  header("Location: index.html#register");
}
//CHECK IF A PASSWORD WAS ENTERED
if(strlen($enteredPassword) > 0 && isset($enteredPassword)){

} else {
  //REDIRECTS BACK TO REGISTER PAGE
  header("Location: index.html#register");
}
//CHECK IF A CONFIRMATION PASSWORD WAS ENTERED
if(strlen($enteredConfirmPassword) > 0 && isset($enteredConfirmPassword)){
  
} else {
  //REDIRECTS BACK TO REGISTER PAGE
  header("Location: index.html#register");
}

//CHECK IF THE PASSWORD AND THE CONFIRMATION PASSWORD ARE THE SAME
if(strlen($enteredPassword) > 0 && $enteredPassword == $enteredConfirmPassword){

  //HASH THE ENTERED PASSWORD
  $hashed = hash('sha512', $enteredPassword);
  //QUERIES TO INSERT THE ENTERED USERNAME AND A HASHED PASSWORD
  $insert_query = "INSERT INTO TestUsers (id, username, password, tableName) VALUES (NULL, '$enteredUsername', '$hashed', 'NULL');";
  $stmt = $db->prepare($insert_query);
  $r = $stmt->execute();
  
  //SOMEHOW PERSIST LOGIN VALUES INTO DASHBOARD
  header("Location: registerSuccess.html");
  
} else {
  //SOMEHOW DISPLAY THAT PASSWORDS ARE DIFFERENT
  header("Location: index.html#register");
}



?>