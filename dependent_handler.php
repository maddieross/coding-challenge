<?php
session_start();

$first_name = test_input($_POST['first_name']);
$last_name = test_input($_POST['last_name']);
$ID = $_SESSION['ID'];
$employee_ID = $_SESSION['employee_ID'];

if (empty($first_name) || empty($last_name)) {
    $messages = "text boxes can not be left blank";
    $valid = false;
}else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
    $messages[$x] = "only letters and white space allowed for name"; 
    $x++;
    $valid = false;
}

if($valid == false){
    $_SESSION['messages'] = $messages;
    header("Location: dependent.php");
    exit;
} 

require_once 'Dao.php';
$dao = new Dao();
$dao->newDependent($ID, $employee_ID, $first_name, $last_name);  

if($_SESSION['dependents']){
    $dependents = $_SESSION['dependents']-1;
}else{
    $dependents = 0;
}

if($dependents != 0){
    $_SESSION['dependents'] = $dependents; 
    header('Location: dependent.php');
    exit;
}

$dao->updateBenDeduction($ID, $employee_ID); 
header('Location: edit_employee.php');
exit;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>