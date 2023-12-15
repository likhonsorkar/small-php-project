<?php 
    require('config.php');
    $fname = $lname = $email = $password1 = $password2 = '';
    $fnameerr = $lnameerr = $emailerr = $password1err = $password2err = $againpasserr = $extramsg =""; 
    if(isset($_POST['submit'])){
        if(empty($_POST['fname'])){
            $fnameerr = "Frist Name Required";
        }else{
            $fname = $_POST['fname'];
        }

        if(empty($_POST['lname'])){
            $lnameerr = "Last Name Required";
        } else{
            $lname = $_POST['lname'];
        }

        if(empty($_POST['email'])){
            $emailerr = "Email Required";
        }else{
            $email = $_POST['email'];
        }

        if(empty($_POST['password1'])){
            $password1err = "Password Required";
        } 


        if(empty($_POST['password2'])){
            $password2err = "Again Password Required";
        }
        if($_POST['password1'] != $_POST['password2'] && !empty($_POST['password1']) && !empty($_POST['password2'])){
           $againpasserr = "Password and again password did not match<br>"; 
        }else{
            if(!empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['fname']) && !empty($_POST['lname']) ){
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $password = md5($_POST['password1']);
                $sqlcheck = "SELECT * FROM student_profile WHERE email ='$email'";
                $checkquery = mysqli_query($connect,$sqlcheck);
                if(mysqli_num_rows($checkquery)>0){
                    $extramsg = "User already exist please try to login"; 
                }else{
                    $sql = "INSERT INTO student_profile (fname,lname,email, password) VALUES ('$fname', '$lname', '$email', '$password')";
                    $query = mysqli_query($connect,$sql);
                    if($query){
                        header('location:login.php?usercreatesuccess');
                    }else{
                        $extramsg = 'Sorry User Create not succesfull';
                    }
                }

            }else{
    
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4"> 

            </div>
            <div class="col-4 mt-5"> 
                <!-- Registration Form -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <span class="link-danger"><?php echo $extramsg;?><br></span>
                        <label for="fname" class="form-label mt-2">Frist Name: </label>
                        <span class="link-danger"><?php echo $fnameerr;?></span>
                        <input type="text" name="fname" class="form-control" value="<?php echo $fname;?>">

                        <label for="lname" class="form-label mt-2">Last Name: </label>
                        <span class="link-danger"><?php echo $lnameerr;?></span>
                        <input type="text" name="lname" class="form-control" value="<?php echo $lname;?>">

                        <label for="email" class="form-label mt-2">email: </label>
                        <span class="link-danger"><?php echo $emailerr;?></span>
                        <input type="email" name="email" class="form-control" value="<?php echo $email;?>">

                        <label for="password1" class="form-label mt-2">Password: </label>
                        <span class="link-danger"><?php echo $password1err;?></span>
                        <input type="password" name="password1" class="form-control">

                        <label for="password2" class="form-label mt-2">Again Password: </label>
                        <span class="link-danger"><?php echo $password2err;?></span>
                        <input type="password" name="password2" class="form-control">

                        <span class="link-danger"><?php echo $againpasserr;?></span>

                        <button type="submit" class="mt-2 btn btn-success" name="submit">Registration</button>
                </form>
                <h5 class="mt-1">Have an account? <a href="login.php">Login</a> </h5>
            </div>
            <div class="col-4"> 

            </div>
        </div>
    </div>
    
<!-- bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>