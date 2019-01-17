<?php
session_start();

$first_name = test_input($_POST['first_name']);
$last_name = test_input($_POST['last_name']);
$paycheck = test_input($_POST['paycheck']);
$dependents = test_input($_POST['dependents']);
$ID = $_SESSION['ID'];

if (empty($first_name) || empty($last_name)) {
    $messages[$x] = "first or last name can not be left empty";
    $x++;
    $valid = false;
}else if(!preg_match("/^[a-zA-Z ]*$/",$name)) {
    $messages[$x] = "only letters and white space allowed for name"; 
    $x++;
    $valid = false;
}

if(empty($paycheck)){
    $messages[$x] = "paycheck can not be left empty";
    $valid = false;
}

if($valid == false){
    $_SESSION['messages'] = $messages;
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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>