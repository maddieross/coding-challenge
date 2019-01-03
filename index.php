<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <header><title>Paylocity Coding Challenge</title></header>
    <h1><a href="index.php">Coding Challenge</a></h1> 
 

    <body>
        <form method="post" action="input_handler.php">
            <input type="text" id="name" name="name" placeholder="name">
            <input type="radio" id="employee" name="employee" value="employee"
                checked>
            <label for="employee">employee</label>
            <input type="radio" id="dpendent" name="dependent" value="dependent"
                checked>
            <label for="dependent">dependent</label>
        </form> 
        <button>+</button>
    </body>
</html>