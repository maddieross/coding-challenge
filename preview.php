<?php 
	session_start();
	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
        exit;
      }
      $_SESSION['logged_in'] = true;
?>

<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <header><title>Paylocity Coding Challenge</title></header>
    <h1><a href="index.php">Coding Challenge</a></h1> 
    <body>
        Preview of Cost
            <table style="width:100%">
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th> 
                    <th>Paycheck</th>
                    <th>Total Benefit Deducted</th>
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
    </body> 
</html>