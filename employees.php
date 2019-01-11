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
        for($y = 0; $y < sizeOf($results); $y++){
            $employee_ID = $results[$x][$y]; 
            echo "employee ID: ".$employee_ID."<br>"; 
            echo "Last Name: ".$results[$x][$y+1]."<br>";
            echo "First Name: ".$results[$x][$y+2]."<br>";    
        }
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