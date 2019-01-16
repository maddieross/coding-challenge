<?php
session_start();
$paycheck = $_POST['paycheck'];
require_once 'Dao.php';
$dao = new Dao();
$dao->updatePaycheck($_SESSION['ID'], $_SESSION['employee_ID'], $paycheck);
$_SESSION['messages'] = 'paycheck updated';
header('Location: edit_employee.php');
exit;

?>