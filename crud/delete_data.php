<?php
    require('config.php');
    if(isset($_GET['id'])){
        $sql = "DELETE FROM user_list WHERE id = '" . $_GET['id'] . "'";
        if(mysqli_query($conn,$sql)){
            header('location:read_data.php?message=User Delete Success&type=succes');
        }else{
            header('location:read_data.php?message=User Delete Failed. Please try again later&type=failed');
        }
    }
?>

