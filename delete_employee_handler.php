<?php
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    if(iset($_GET["a"])){
        $employee_ID = $_GET["a"];
    }else{
        $employee_ID = $_SESSION['employee_ID'];
    }
    $dao->deleteEmployee($_SESSION['ID'], $_GET["a"]);
    $_SESSION['messages'] = 'employee successfully deleted';
    header('Location: employees.php');
    exit;
?>