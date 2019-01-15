<?php
session_start();
require_once 'Dao.php';
$dao = new Dao();
$dao->deleteAccount($_SESSION['ID']); 
session_unset(); 
session_destroy();
header("Location:index.php");
exit;
?>