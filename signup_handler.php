<?php
session_start();

require_once 'Dao.php';
$dao = new Dao();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$_password = $_POST['password_check'];



if (empty($name)) {
  $messages = "PLEASE FILL OUT ALL TEXT BOXES";
  $_SESSION['messages'] = $messages;
  $valid = false;
  header("Location: index.php");
  exit;
}

if (empty($email)) {
  $messages = "PLEASE FILL OUT ALL TEXT BOXES";
  $_SESSION['messages'] = $messages;
  $valid = false;
  header("Location: index.php");
  exit;
}

if (empty($password)) {
  $messages = "PLEASE FILL OUT ALL TEXT BOXES";
  $_SESSION['messages'] = $messages;
  $valid = false;
  header("Location: index.php");
  exit;
}

if($password != $_password){
  $messages = "passwords do not match";
  $_SESSION['messages'] = $messages;
  $valid = false;
  header("Location: index.php");
  exit;
}


//Validate Email 
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $messages = "email is not a valid email address";
  $valid = false;
  $_SESSION['sentiment'] = "bad";
  $_SESSION['messages'] = $messages;
  header("Location: index.php");
  exit;
}

$results = $dao->signup($name, $email, $passowrd); 

if($results = NULL){
  $messages = "an account is already associated with the email entered";
  $valid = false;
  $_SESSION['sentiment'] = "bad";
  $_SESSION['messages'] = $messages;
  header("Location: index.php");
  exit;
}

$messages = "Thanks for creating an account!";
header('Location: account.php');
exit; 


?>

