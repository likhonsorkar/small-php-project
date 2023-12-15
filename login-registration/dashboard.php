<?php 
    session_start();
    if(empty($_SESSION['fname']) && empty($_SESSION['lname']) && empty($_SESSION['email'])){
        header('location:login.php?logoutsuccess');
    }else{
        echo  "Name: ".$_SESSION['fname']." ".$_SESSION['lname']."<br> Email: ".$_SESSION['email'];
    }
    
?>
<br>
<a href="logout.php">logout</a>