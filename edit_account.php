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
            <li><a href="preview.php">preview of benefit deduction</a></li>
            <li><a href="add_employee.php">add an employee</a></li>
            <li><a href="employees.php">edit employee list</a></li>
            <li><a href="logout_handler.php">logout</a></li>
        </ul>
        <div class="main">
            <h1><a href="index.php">Coding Challenge</a></h1> 
            <br>
            <?php
                if (isset($_SESSION['messages'])) {
                echo $_SESSION['messages'].'<br>';
                }
                unset($_SESSION['messages']);
            ?>
            <form method="post" action="edit_handler.php">
                <label for="password">Old Password:</label><br>
                <input type="password" id="old_password" name="old_password" placeholder="password"><br>
                <label for="email">New Email:</label><br>
                <input type="text" id="email" name="email" placeholder="you@example.com"><br>
                <label for="password">New Password:</label><br>
                <input type="password" id="new_password" name="new_password" placeholder="password"><br>
                <label for="password">New Password:</label><br>
                <input type="password" id="new_password_check" name="new_password_check" placeholder="re-enter password"><br>
                <input type="submit" value="Update">
            </form> 
        </div>        
    </body> 
</html>