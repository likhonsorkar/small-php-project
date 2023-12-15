<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'crud';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(!$conn){
        die("database not connected. Please check it.");
    }else{
         // echo "Database Connected Succesfull!<br>";
    }
?>