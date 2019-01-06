<?php
    session_start();
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
            
    </body> 
</html>