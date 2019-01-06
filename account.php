<?php
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
 ?>
<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <header><title>Paylocity Coding Challenge</title></header>
    <h1><a href="index.php">Coding Challenge</a></h1> 
    <body>
        <?php
            if (isset($_SESSION['messages'])) {
            echo $_SESSION['messages'];
            }
            unset($_SESSION['messages']);
        ?>

        <a href="benefit.php">preview of cost</a>
        <a href="add_employee.php">add an employee</a>
        <a href="employees.php">edit employee list</a>
        <a href="edit_account.php">change account settings</a>
        <a href="logout_handler.php">Logout</a>
        

            
    </body> 
</html>