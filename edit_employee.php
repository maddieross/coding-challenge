<?php
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    $employee_info = $dao->employeeInfo($_SESSION['ID'], $_GET["a"]);
    $dependent_info = $dao->dependentInfo($_SESSION['ID'], $_GET["a"]);
    $employee_ID = $employee_info[0]; 
?>
<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <header><title>Paylocity Coding Challenge</title></header>
    <body>
        <ul>
            <li><a class="active" href="account.php">account</a></li>
            <li><a href="preview.php">preview of benefit deduction</a></li>
            <li><a href="add_employee.php">add an employee</a></li>
            <li><a href="employees.php">edit employee list</a></li>
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
            <h3>Employee Information</h3>
            <?php
                echo $employee_info[1].", ".$employee_info[2];
                echo "<br> Paycheck before taxes: ".$employee_info[3];
                echo "<br> Amount deducted for benefits: ".$employee_info[6];
            ?>    
            <table>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th> 
                    <th>          </th>
                </tr>
                <?php
                    for($x = 0; $x < sizeof($dependent_info); $x++){
                        echo "<tr>";
                        echo "<td>".$dependent_info[$x][0]."</td>";
                        echo "<td>".$dependent_info[$x][1]."</td>";
                        echo "<td><a href=\"delete_dependent_handler.php?a=".$employee_ID.",b=".$dependent_info[$x][1]."\">delete</a></td>";
                        echo "</tr>";
                    }
                ?>
            </table>     
        </div>   
    </body> 
</html>