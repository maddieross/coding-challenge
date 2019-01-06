<?php
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

require_once 'Dao.php';
$dao = new Dao();
$results = $dao->loginIn($login, $passowrd); 

if ($results) {
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $login;
    header('Location: account.php');
    exit;
}

$_SESSION['logged_in'] = false;
$message = "Username or password invalid";
$_SESSION['messages'] = $message;

header('Location: login.php');
exit;

?>