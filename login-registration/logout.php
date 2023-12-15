<?php
    session_start();
    session_destroy();
    if(!isset($_COOKIE['useremail']) && !isset($_COOKIE['userpassword'])){
        echo "Cookie is not set <br>";
    }else{
        setcookie('useremail', $email, time() - 3600, '/');
        setcookie('userpassword',  $password, time() - 3600, '/');
    }
    header('location:login.php?logoutsuccess')
?>