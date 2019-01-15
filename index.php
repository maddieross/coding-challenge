<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <header><title>Paylocity Coding Challenge</title></header>
    <h1><a class="index"href="index.php">Coding Challenge</a></h1> 
    <body>
        <?php
            if (isset($_SESSION['messages'])) {
            echo $_SESSION['messages'];
            }
            unset($_SESSION['messages']);
        ?>
        <div class="center">
            <div class="login">
                <h3>Login</h3>
                <form method="post" action="login_handler.php">
                    <label for="login">Email:</label><br>
                    <input type="text" id="login" name="login" placeholder="you@example.com"><br>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" placeholder="password"><br>
                    <input type="submit" value="Login">
                </form> 
            </div> 
            
            <div class="signup">
                <h3>Sign Up</h3>
                <form method="post" action="signup_handler.php">
                    <label for="login">Company Name:</label><br>
                    <input type="text" id="name" name="name" placeholder="name"><br>
                    <label for="login">Email:</label><br>
                    <input type="text" id="email" name="email" placeholder="you@example.com"><br>
                    <label for="login">Password:</label><br>
                    <input type="password" id="password" name="password" placeholder="password"><br>
                    <label for="login">Password:</label><br>
                    <input type="password" id="password_check" name="password_check" placeholder="re-enter password"><br>
                    <input type="submit" value="Create Account">
                </form> 
            </div> 
        </div> 
    </body> 
</html>