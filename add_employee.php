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
    <body>
        <ul>
            <li><a href="account.php">account</a></li>
            <li><a href="preview.php">preview</a></li>
            <li><a class="active" href="add_employee.php">add an employee</a></li>
            <li><a href="employees.php">edit employee list</a></li>
            <li><a href="logout_handler.php">logout</a></li>
        </ul>    
        <div class="main">
            <h1>Coding Challenge</h1> 
            <?php
               
                if (isset($_SESSION['messages'])) {
                    $messages = $_SESSION['messages'];
                    for($x = 0; $x<sizeof($messages); $x++){
                        echo $messages[$x]."<br>";
                    }
                }
                    unset($_SESSION['messages']);
            ?>
            <h3>Employee Information</h3>
                <form method="post" action="employee_handler.php">
                    <label for="first_name">First Name:</label><br>
                    <input type="text" id="first_name" name="first_name" placeholder="first name"><br>
                    <label for="last_name">Last Name:</label><br>
                    <input type="text" id="last_name" name="last_name" placeholder="last name"><br>
                    <label for="paycheck_amount">Paycheck Amount:</label><br>
                    <input type="number" id="paycheck" name="paycheck" placeholder="2000"><br>
                    <label for="dependents">Number of Dependents:</label><br>
                    <input type="number" id="dependents" name="dependents" placeholder="0"><br>
                    <input type="submit" value="add employee">
                </form> 
        </div>         
    </body> 
</html>