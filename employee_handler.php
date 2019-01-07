<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$paycheck_amount = $_POST['paycheck_amount'];
$dependents = $_POST['dependents'];
$user_ID =     $_SESSION['user_ID'] = $results[0];
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