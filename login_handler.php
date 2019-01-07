<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
require_once 'Dao.php';
$dao = new Dao();
$results = $dao->loginIn($email, $password);  
if ($results) {
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $login;
    header('Location: account.php');
    exit;
}

$_SESSION['logged_in'] = false;
$message = "Username or password invalid";
$_SESSION['messages'] = $messages;

header('Location: index.php');
exit;

?>