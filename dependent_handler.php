<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$user_ID = $_SESSION['user_ID'];
$employee_ID = $_SESSION['employee_ID'];
$num_dependents = $_SESSION['num_dependents']-1;

require_once 'Dao.php';
$dao = new Dao();
$employee_ID = $dao->newDependent($user_ID, $first_name, $last_name);  

if($num_dependents != 0){
    $_SESSION['num_dependents'] = $num_dependents; 
    header('Location: dependent.php');
    exit;
}

header('Location: employees.php');
exit;


?>