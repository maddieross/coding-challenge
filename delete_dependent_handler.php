<?php
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    $dao->deleteDependent($_SESSION['ID'], $_GET["a"], $_GET["b"]);
    $_SESSION['messages'] = 'dependent successfully deleted';
    //header('Location: edit_employee.php');
    //exit;
?>