<?php
session_start();

$email = $_POST['login'];
$password = $_POST['password'];
require_once 'Dao.php';
$dao = new Dao();
$results = $dao->loginIn($email, $password);  
if ($results) {
    $_SESSION['logged_in'] = true;
    $_SESSION['ID'] = $results[0];
    $_SESSION['name'] = $results[1];
    header('Location: account.php');
    exit;
}

$_SESSION['logged_in'] = false;
$messages = "Username or password invalid";
$_SESSION['messages'] = $messages;

header('Location: index.php');
exit;

?>