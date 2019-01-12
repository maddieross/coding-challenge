<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$ID = $_SESSION['ID'];
$employee_ID = $_SESSION['employee_ID'];
$dependents = $_SESSION['dependents']-1;

require_once 'Dao.php';
$dao = new Dao();
$dao->newDependent($ID, $employee_ID, $first_name, $last_name);  

if($dependents != 0){
    $_SESSION['dependents'] = $dependents; 
    header('Location: dependent.php');
    exit;
}

$dao->updateBenDeduction($ID, $employee_ID); 
header('Location: employees.php');
exit;


?>