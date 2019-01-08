<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$paycheck_amount = $_POST['paycheck_amount'];
$dependents = $_POST['dependents'];
$user_ID = $_SESSION['user_ID'];

/*
require_once 'Dao.php';
$dao = new Dao();
$results = $dao->newEmployee($user_ID, $first_name, $last_name, $paycheck, $dependents);  


if($dependents != 0){
    $_SESSION['employee_ID'] = $results; 
    $_SESSION['dependents'] = $dependents;
    echo $first_name[0]; 
}
*/
echo $first_name[0];

?>