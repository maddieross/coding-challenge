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
            <li><a class="active" href="account.php">account</a></li>
            <li><a href="preview.php">preview</a></li>
            <li><a href="add_employee.php">add an employee</a></li>
            <li><a href="employees.php">edit employee list</a></li>
            <li><a href="logout_handler.php">logout</a></li>
        </ul>
        <div class="main">
            <h1>Coding Challenge</h1> 
            <?php
                if (isset($_SESSION['messages'])) {
                echo $_SESSION['messages'].'<br>';
                }
                unset($_SESSION['messages']);
                echo '<h3>Welcome '.$_SESSION['name'].'</h3>'; 
                echo '<br> Email: '.$_SESSION['email']; 
            ?>
            <br>
            <a href="edit_account.php">edit account</a>
            <a href="delete_account_handler.php">delete account</a>
        </div>  
    </body> 
</html>