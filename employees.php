<?php 
	session_start();
	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
        exit;
      }
      $_SESSION['logged_in'] = true;
    require_once 'Dao.php';
    $dao = new Dao();
    $results = $dao->displayEmployees($_SESSION['ID']);  
    ?>


<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <header><title>Coding Challenge</title></header>
    <body>
        <ul>
            <li><a href="account.php">account</a></li>
            <li><a href="preview.php">preview</a></li>
            <li><a href="add_employee.php">add an employee</a></li>
            <li><a class="active" href="employees.php">edit employee list</a></li>
            <li><a href="logout_handler.php">logout</a></li>
        </ul>
        <div class="main">
            <h1>Coding Challenge</h1> 
            <?php
                if (isset($_SESSION['messages'])) {
                echo $_SESSION['messages'];
                }
                unset($_SESSION['messages']);
                
            ?>
            <br>
            <h3>Employees</h3>
            <table>
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
        </div>    
    </body> 
</html>