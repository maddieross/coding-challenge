<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
echo $login;
echo $password;
require_once 'Dao.php';
$dao = new Dao();
echo '1';
$results = $dao->loginIn($email, $password); 
echo '2'; 
if ($results) {
    $_SESSION['logged_in'] = true;
   // $_SESSION['email'] = $login;
    header('Location: account.php');
    exit;
}

$_SESSION['logged_in'] = false;
$message = "Username or password invalid";
$_SESSION['messages'] = $results[0];

header('Location: index.php');
exit;

?>