<?php
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    $dao->deleteEmployee($_SESSION['ID'], $_GET["a"]);
    header('Location: employees.php');
    exit;
?>