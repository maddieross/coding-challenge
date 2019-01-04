<?php 
    if(isset($_POST['duplicates']))
    {
        $numOfForms = $_POST['duplicates']; 
        echo $numOfForms; 
    }