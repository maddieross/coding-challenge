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
    <div class="employee">
          Dependent Information
            <form method="post" action="dependent_handler.php">
                <label for="first_name">First Name:</label><br>
                <input type="text" id="first_name" name="first_name" placeholder="first name"><br>
                <label for="last_name">Last Name:</label><br>
                <input type="text" id="last_name" name="last_name" placeholder="last name"><br>
                <input type="submit" value="add dependent">
            </form> 
        </div>         
    </body> 
</html>