<?php
    require('config.php');
    $fnamerr = $lnamerr = $emailrr = $phonerr = $addressrr = $imagerr = $extramsg = $birthrr ='';
    $fname = $lname = $email = $phone = $address = $gender ='';
    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $target_dir = "images/";
        if(empty($fname)){
            $fnamerr = "Frist Name Required";
        }
        if(empty($lname)){
            $lnamerr = "Last Name Required";
        }
        if(empty($email)){
            $emailrr = "Email Required";
        }
        if(empty($phone)){
            $phonerr = "Phone number Required";
        }
        if(empty($address)){
            $addressrr = "Address Required";
        }
        if(empty($birthdate)){
           
        }
        
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $targent_tile_tmp  = $_FILES["image"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check file size
        if ($_FILES["image"]["size"] > 999000) {
            $imagerr = "Sorry, your file is too large.";
            $uploadOk = 0;
        } 
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $imagerr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1 && !empty($fname) && !empty($lname) && !empty($email) &&  !empty($phone) && !empty($address) && !empty($birthdate))  {
            $sqlcheck = "SELECT * FROM user_list WHERE email ='$email' or phone = '$phone'";
            $checkquery = mysqli_query($conn,$sqlcheck);
            if(mysqli_num_rows($checkquery)>0){
                $extramsg = "User already exist please try Another"; 
            }else{
                if(move_uploaded_file($targent_tile_tmp, $target_file)){
                    $sql = "INSERT INTO user_list (fname,lname,email,phone,address,profile_img,gender,birth_date) VALUES ('$fname', '$lname', '$email', '$phone','$address', '$target_file', '$gender', '$birthdate')";
                    $query = mysqli_query($conn,$sql);
                    if($query){
                        header('location:read_data.php?message=New user create Successfull&type=succes');
                    }else{
                        $extramsg = 'Sorry User Create not succesfull';
                    }
                }else{
                    $imagerr = "Sorry, Image Upload Problem! Please try later.";
                }
                
            }
          }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Create</title>
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

  <div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
        
            <form action="create_data.php" class="form-group" method="POST" enctype="multipart/form-data">
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

                    <div class="row">
                        <div class="col-3">
                        <img id="imagePreview" class="img-fluid rounded" alt="Image Preview"  src="https://placehold.co/151x188">
                        </div>
                        <div class="col-9">
                           <ul>
                            <li>only JPG, JPEG, PNG & GIF files are allowed</li>
                            <li>Use upto 999KB </li>
                            <li>Size 40MM*50 MM</li>
                           </ul>
                        </div>
                    </div>
                    <label for="image" class="form-label mt-1">Photo : </label>
                    <span class="link-danger"><?php echo $imagerr;?><br></span>
                    <!-- Add an ID to the image tag for preview -->
                    <input type="file" name="image" class="form-control" onchange="previewImage(this)">
                    <small class="text-muted">Select an image to preview</small> <br>
                    
                    <button type="submit" class="btn btn-success mt-2" name="submit">Submit Data</button>
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