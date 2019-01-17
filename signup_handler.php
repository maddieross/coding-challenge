<?php
session_start();

require_once 'Dao.php';
$dao = new Dao();

$name = test_input($_POST['name']);
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);
$_password = test_input($_POST['password_check']);
$x = 0; 

if (empty($name)) {
  $messages[$x] = "name must be filled";
  $x++; 
  $valid = false;
}else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  $messages[$x] = "only letters and white space allowed for name"; 
  $x++;
  $valid = false;
}

if (empty($email)) {
  $messages[$x] = "email can not be left empty";
  $x++; 
  $valid = false;
}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $messages[$x] = "email is not a valid email address";
  $x++;
  $valid = false;
}

if (empty($password)) {
  $messages[$x] = "password can not be left empty";
  $x++;
  $valid = false;
}

if($password != $_password){
  $messages[$x] = "passwords do not match";
  $valid = false;
}

if($valid == false){
  $_SESSION['messages'] = $messages;
  header("Location: index.php");
  exit;
}

$results = $dao->signup($name, $email, $password); 

if($results == NULL){
  $messages = "an account is already associated with the email entered";
  $_SESSION['messages'] = $messages;
  header("Location: index.php");
  exit;
}

$messages = "Thanks for creating an account!";
$_SESSION['messages'] = $messages;
$_SESSION['logged_in'] = true;
$_SESSION['ID'] = $results;
$_SESSION['name'] = $name;
$_SESSION['email'] = $email; 
header('Location: account.php');
exit; 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

