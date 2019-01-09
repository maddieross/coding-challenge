<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$paycheck_amount = $_POST['paycheck_amount'];
$num_dependents = $_POST['dependents'];
$user_ID = $_SESSION['user_ID'];

/*
require_once 'Dao.php';
$dao = new Dao();
$employee_ID = $dao->newEmployee($user_ID, $first_name, $last_name, $paycheck, $dependents);  
*/
echo $num_dependents;
/*
if($num_dependents != 0){
    $_SESSION['employee_ID'] = $results; 
    $_SESSION['num_dependents'] = $num_dependents; 
    header('Location: dependent.php');
    exit;
}

header('Location: employees.php.php');
exit;
*/

?>