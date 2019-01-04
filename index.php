<html>
    <link href="index.css" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="add-input-form.js"></script>
    <header><title>Paylocity Coding Challenge</title></header>
    <h1><a href="index.php">Coding Challenge</a></h1> 
 

    <body>
        <div class = "user-input">
            <form method="post" action="input_handler.php">
                <input type="text" id="name" name="name" placeholder="name">
                <input type="radio" id="employee" name="employee-dependent" value="employee"
                    checked>
                <label for="employee">employee</label>
                <input type="radio" id="dpendent" name="employee-dependent" value="dependent">
                <label for="dependent">dependent</label>
            </form> 
        </div> 
        <div class = "add">
            <button>+</button>
        </div>

        <div class = "calculate">
            <button>calculate</button>
        </div> 

        <?php
            if(isset($_POST['duplicate']))
            {
                $numberOfEntrys = $_POST['duplicate']; 
                echo $numberOfEntrys;
            }   
        ?>
    </body>
</html>