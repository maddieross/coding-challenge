<?php
session_start();

require_once 'Dao.php';
$dao = new Dao();

$name = $_POST['name'];
echo $name;
$email = $_POST['email'];
echo $email;
$password = $_POST['password'];
echo $password;
$_password = $_POST['password_check'];
echo $_password; 


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

if(var_dump($password != $_password)){
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

$results = $dao->signup($login, $passowrd); 

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

