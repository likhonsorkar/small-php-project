<?php
    require('config.php');
    $fnamerr = $lnamerr = $emailrr = $phonerr = $addressrr = $imagerr = $extramsg = $birthrr ='';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $readsql = "SELECT * FROM user_list WHERE id=".$id."";
        $readquery = mysqli_query($conn, $readsql);
        if(mysqli_num_rows($readquery)>0){
                $row = mysqli_fetch_assoc($readquery);
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $phone = $row['phone'];
                $gender = $row['gender'];
                $address = $row['address'];
                $birthdate = $row['birth_date'];
                $photolink = $row['profile_img'];
        }
    }
    if(isset($_POST['submit'])){
        $ufname = $_POST['fname'];
        $ulname = $_POST['lname'];
        $uemail = $_POST['email'];
        $uphone = $_POST['phone'];
        $uaddress = $_POST['address'];
        $ugender = $_POST['gender'];
        $ubirthdate = $_POST['birthdate'];
        if(empty($ufname)){
            $fnamerr = "Frist Name Required";
        }
        if(empty($ulname)){
            $lnamerr = "Last Name Required";
        }
        if(empty($uemail)){
            $emailrr = "Email Required";
        }
        if(empty($uphone)){
            $phonerr = "Phone number Required";
        }
        if(empty($uaddress)){
            $addressrr = "Address Required";
        }
        

        if (!empty($ufname) && !empty($ulname) && !empty($uemail) &&  !empty($uphone) && !empty($uaddress) && !empty($ubirthdate))  {
                    $upsql = "UPDATE user_list SET fname = '$ufname', lname = '$ulname', phone = '$uphone', email = '$uemail', address = '$uaddress', gender = '$ugender', birth_date = '$ubirthdate' WHERE id='$id'";
                    $upquery = mysqli_query($conn,$upsql);
                    echo $upquery;
                    if($upquery){
                        header('location:read_data.php?message=User data update Successfull&type=succes');
                    }else{
                        header('location:read_data.php?message=User data update failed&type=failed');
                    }    
          }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

  <div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
        
            <form action="update_data.php?id=<?php echo $id?>" class="form-group" method="POST">
                <div class="form-group border border-primary shadow-sm p-3 mb-5 bg-white rounded mt-5">
                    <h3 class="text-center"> Create user data </h3>
                    <span class="link-danger"><?php echo $extramsg;?><br></span>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <label for="fname" class="form-label mt-1">Frist Name: </label>
                            <span class="link-danger"><?php echo $fnamerr;?><br></span>
                            <input type="text" name="fname" class="form-control" value="<?php echo $fname;?>">
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <label for="lname" class="form-label mt-1">Last Name: </label>
                            <span class="link-danger"><?php echo $lnamerr;?><br></span>
                            <input type="text" name="lname" class="form-control" value="<?php echo $lname;?>">
                        </div>
                    </div>
                    <label for="email" class="form-label mt-1">Email: </label>
                    <span class="link-danger"><?php echo $emailrr;?><br></span>
                    <input type="text" name="email" class="form-control" value="<?php echo $email;?>">
                    <label for="phone" class="form-label mt-1">Phone : </label>
                    <span class="link-danger"><?php echo $phonerr;?><br></span>
                    <input type="phone" name="phone" class="form-control" value="<?php echo $phone;?>">
                    
                    <label for="gender" class="form-label mt-1">Gender: </label>
                    <select name="gender" class="form-control">
                        <option value="male" <?php echo ($gender == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo ($gender == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo ($gender == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>

                    <span class="link-danger"><?php echo $birthrr;?><br></span>
                    <label for="birthdate" class="form-label mt-1">Birth Date: </label>
                    <input type="date" name="birthdate" class="form-control" value="<?php echo $birthdate; ?>">

                    <label for="address" class="form-label mt-1">Address: </label>
                    <span class="link-danger"><?php echo $addressrr;?><br></span>
                    <textarea type="text" name="address" class="form-control mb-1" rows="5"><?php echo $address;?></textarea>
                    
                    <button type="submit" class="btn btn-success mt-2" name="submit">Update Data</button>
                </div>
            </form>
        </div>
        <div class="col-lg-2 col-md-2"></div>
    </div>
  </div>
   
  <script>
        // Function to display image preview
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
<!-- bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>