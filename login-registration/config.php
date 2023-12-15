<?php
    $dbhostname = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'user';
    $connect = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname);
    if(!$connect){
        die("Database Connection Faild<br>");
    }else{
        // echo "Database Connected Succesfull!<br>";
    }
?>