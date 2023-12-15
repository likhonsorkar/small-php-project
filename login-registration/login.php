<?php 
    session_start();

    $emailerr = $passworderr = $email = $succesmsg ='';

    if(!isset($_COOKIE['useremail']) && !isset($_COOKIE['userpassword'])){
    }else{
        $coockieuseremail = $_COOKIE['useremail'];
        $coockieuserpassword = $_COOKIE['userpassword'];
        login($coockieuseremail,$coockieuserpassword);
        echo $coockieuseremail;
    }
    

    if(isset($_GET['usercreatesuccess'])){
        $succesmsg = 'User created succesfull';
    }
    if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $emailerr = "Email Required";
        }else{
            $email = $_POST['email'];
        }

        if(empty($_POST['password'])){
            $passworderr = "Password Required";
        } else{

        }

        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            if (isset($_POST['remember']) && $_POST['remember'] == "checked"){
                setcookie('useremail', $email, time() + (3600 * 24 * 365), '/');
                setcookie('userpassword',  $password, time() + (3600 * 24 * 365), '/');
            } 
            login($email,$password);           
        }else{

        }
    }
    function login($useremail,$usermd5password){
            require('config.php');
            $email = $useremail;
            $password = $usermd5password;
            $sqlcheck = "SELECT * FROM student_profile WHERE email ='$email' and password = '$password'";
            
            $checkquery = mysqli_query($connect,$sqlcheck);
            if(mysqli_num_rows($checkquery)>0){
                while($row = $checkquery->fetch_assoc()) {
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['lname'] = $row['lname'];
                    $_SESSION['email'] = $row['email'];
                  }
                  header('location:dashboard.php?loginsuccess');
            }else{
                echo "User Not Found<br>";
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
                        <span class="link-success"><?php echo $succesmsg;?><br></span>
                        <label for="email" class="form-label mt-2">Email: </label>
                        <span class="link-danger">*<?php echo $emailerr;?></span>
                        <input type="email" name="email" class="form-control" value="<?php echo $email;?>">

                        <label for="password" class="form-label mt-2">Password: </label>
                        <span class="link-danger">*<?php echo $passworderr; ?></span>
                        <input type="password" name="password" class="form-control">
                        <label>
                        <input type="checkbox" name="remember" value="checked" checked> Remember me
                        </label> <br>
                        <button type="submit" class="mt-2 btn btn-success" name="submit">Login</button>
                </form>
                <h5 class="mt-1">Don't have account? <a href="registration.php">Register</a> </h5>
            </div>
            <div class="col-4"> 

            </div>
        </div>
    </div>
    
<!-- bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>