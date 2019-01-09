<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$user_ID = $_SESSION['user_ID'];


require_once 'Dao.php';
$dao = new Dao();
$employee_ID = $dao->newDependent($user_ID, $first_name, $last_name);  


if($dependents != 0){
    $_SESSION['employee_ID'] = $results; 
    $_SESSION['num_dependents'] = $dependents-1; 
    header('Location: dependent.php');
    exit;
}

header('Location: employees.php.php');
exit;


?>