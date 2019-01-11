<?php 
	session_start();
	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
        exit;
      }
      $_SESSION['logged_in'] = true;

    require_once 'Dao.php';
    $dao = new Dao();
    $results = $dao->displayEmployees($_SESSION['user_ID']);  
    for($x = 0; $x < sizeof($results); $x++){
        $employee_ID = $results[$x][0]; 
        echo "Last Name: ".$results[$x][1];
        echo " First Name: ".$results[$x][2];
        echo " <a href=\"edit_employee.php?a=".$employee_ID."\">edit</a>";
        echo " <a href=\"delete_employee_handler.php?a=".$employee_ID."\">delete</a><br>";
    }
    ?>


<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <header><title>Paylocity Coding Challenge</title></header>
    <h1><a href="index.php">Coding Challenge</a></h1> 
    <body>

    </body> 
</html>