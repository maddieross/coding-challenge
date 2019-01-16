<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$ID = $_SESSION['ID'];
$employee_ID = $_SESSION['employee_ID'];

if($_SESSION['dependents']){
    $dependents = $_SESSION['dependents']-1;
}else{
    $dependents = 0;
}

if (empty($first_name) || empty($last_name)) {
    $messages = "PLEASE FILL OUT ALL TEXT BOXES";
    $_SESSION['messages'] = $messages;
    $valid = false;
    header("Location: add_employee.php");
    exit;
}

require_once 'Dao.php';
$dao = new Dao();
$dao->newDependent($ID, $employee_ID, $first_name, $last_name);  

if($dependents != 0){
    $_SESSION['dependents'] = $dependents; 
    header('Location: dependent.php');
    exit;
}

$dao->updateBenDeduction($ID, $employee_ID); 
header('Location: edit_employee.php');
exit;

?>