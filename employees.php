<?php 
	session_start();
	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
        exit;
      }
      $_SESSION['logged_in'] = true;
    echo 'here';  
    require_once 'Dao.php';
    $dao = new Dao();
    $results = $dao->displayEmployees($ID);  
    ?>


<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <header><title>Paylocity Coding Challenge</title></header>
    <h1><a href="index.php">Coding Challenge</a></h1> 
    <body>
        Employees
        <table style="width:100%">
            <tr>
                <th>Last Name</th>
                <th>First Name</th> 
                <th>          </th>
            </tr>
            <?php
                for($x = 0; $x < sizeof($results); $x++){
                    $employee_ID = $results[$x][0]; 
                    echo "<tr>";
                    echo "<td>".$results[$x][1]."</td>";
                    echo "<td>".$results[$x][2]."</td>";
                    echo "<td> <a href=\"edit_employee.php?a=".$employee_ID."\">edit</a>";
                    echo " <a href=\"delete_employee_handler.php?a=".$employee_ID."\">delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>     
    </body> 
</html>