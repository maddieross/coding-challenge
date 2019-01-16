<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$paycheck = $_POST['paycheck'];
$dependents = $_POST['dependents'];
$ID = $_SESSION['ID'];

if (empty($first_name) || empty($last_name) || empty($paycheck)) {
    $messages = "PLEASE FILL OUT ALL TEXT BOXES";
    $_SESSION['messages'] = $messages;
    $valid = false;
    header("Location: add_employee.php");
    exit;
}


require_once 'Dao.php';
$dao = new Dao();
$employee_ID = $dao->newEmployee($ID, $first_name, $last_name, $paycheck, $dependents);  


if($dependents && $dependents != 0 ){
    $_SESSION['employee_ID'] = $employee_ID; 
    $_SESSION['dependents'] = $dependents; 
    header('Location: dependent.php');
    exit;
}

header('Location: employees.php');
exit;


?>