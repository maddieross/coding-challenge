<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$paycheck = $_POST['paycheck'];
$dependents = $_POST['dependents'];
$ID = $_SESSION['ID'];
echo $ID; 


require_once 'Dao.php';
$dao = new Dao();
$employee_ID = $dao->newEmployee($ID, $first_name, $last_name, $paycheck, $dependents);  

if($dependents != 0){
    $_SESSION['employee_ID'] = $results; 
    $_SESSION['dependents'] = $dependents; 
    header('Location: dependent.php');
    exit;
}

header('Location: employees.php.php');
exit;


?>