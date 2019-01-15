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
        <ul>
            <li><a href="preview.php">preview of benefit deduction</a></li>
            <li><a href="employees.php">edit employee list</a> <br></li>
            <li><a href="add_employee.php">add an employee</a> <br></li>
            <li><a href="logout_handler.php">logout</a></li>
        </ul>
        <?php
            if (isset($_SESSION['messages'])) {
            echo $_SESSION['messages'].'<br>';
            }
            unset($_SESSION['messages']);
            echo 'Welcome '.$_SESSION['name']; 
            
        ?>
        
        
        

            
    </body> 
</html>