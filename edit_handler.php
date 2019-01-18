<?php
session_start();

require_once 'Dao.php';
$dao = new Dao();

$old_password = test_input($_POST['old_password']);


if (empty($old_password)) {
  $messages = "PLEASE FILL OUT OLD PASSWORD";
  $_SESSION['messages'] = $messages;
  header("Location: edit_account.php");
  exit;
}

$results = $dao->loginIn($_SESSION['email'], $old_password);  

if(!$results){
    $messages = "OLD PASSWORD IS INCORRECT";
    $_SESSION['messages'] = $messages;
    $valid = false;
    header("Location: edit_account.php");
    exit;
}

if(test_input($_POST['new_password'])){
    $new_password = $_POST['new_password'];
    if($new_password != $_POST['new_password_check']){
        $messages = "new passwords do not match";
        $_SESSION['messages'] = $messages;
        $valid = false;
        header("Location: edit_account.php");
        exit;
    }
    $dao->updatePassword($_SESSION['ID'], $new_password); 
}


if($_POST['email']){
    $email = test_input($_POST['email']); 
    //Validate Email 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messages = "email is not a valid email address";
        $_SESSION['messages'] = $messages;
        header("Location: edit_account.php");
        exit;
    }
    $dao->updateEmail($_SESSION['ID'], $email); 
    $_SESSION['email'] = $email; 
}


$messages = "account information updated successfully";
$_SESSION['messages'] = $messages;

header('Location: account.php');
exit; 

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

