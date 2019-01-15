<?php 
	session_start();
	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
        exit;
      }
      $_SESSION['logged_in'] = true;
      require_once 'Dao.php';
      $dao = new Dao();
      $results = $dao->previewOfCost($_SESSION['ID']); 
?>

<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <header><title>Paylocity Coding Challenge</title></header>
    <body>
        <ul>
            <li><a href="account.php">account</a></li>
            <li><a class="active" href="preview.php">preview of benefit deduction</a></li>
            <li><a href="add_employee.php">add an employee</a></li>
            <li><a href="employees.php">edit employee list</a></li>
            <li><a href="logout_handler.php">logout</a></li>
        </ul>
        <div class="main">
            <h1><a href="index.php">Coding Challenge</a></h1> 
            Preview of Cost
            <table>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th> 
                    <th>Paycheck</th>
                    <th>Total Benefits Deducted</th>
                    <th>Amount Deducted per Paycheck</th>
                    <th>Paycheck Before Taxes</th>
                </tr>
                <?php
                    for($x = 0; $x < sizeof($results); $x++){
                        echo "<tr>";
                        echo "<td>".$results[$x][0]."</td>";
                        echo "<td>".$results[$x][1]."</td>";
                        echo "<td>".$results[$x][2]."</td>";
                        echo "<td>".$results[$x][3]."</td>";
                        echo "<td>".($results[$x][3]/26)."</td>";
                        echo "<td>".(($results[$x][2])-($results[$x][3]/26))."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>  
        </div>   
    </body> 
</html>