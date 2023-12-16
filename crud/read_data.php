<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Fetch all data from database</h4>
                    </div>
                    <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <td>
                              <div class="row">
                                <div class="col-6"><h3>User List:</h3> </div>
                                <div class="col-6 text-end"><a href="create_data.php" class="btn btn-success mr-auto"> Create New </a></div>
                              </div>
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "SELECT * FROM user_list";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0){
                              while($row = mysqli_fetch_assoc($result)){
                                $slno = 1;
                                $id = $row['id'];
                                $fullname = $row['fname']." ".$row['lname'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $gender = $row['gender'];
                                $address = $row['address'];
                                $birthdate = $row['birth_date'];
                                $photolink = $row['profile_img'];
                                ?>
                                <tr>
                                <td>
                                  <div class="row">
                                    <div class="col-lg-3 col-md-5 col-sm-4">
                                      <img class = "img-fluid" src="<?php echo $photolink; ?>" height = "200px" width = "auto">
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-sm-8">
                                      <h2>Name: <?php echo $fullname; ?></h2>
                                      <h3>Email: <?php echo $email; ?></h3>
                                      <h3>Phone: <?php echo $phone; ?></h3>
                                      <h3>Gender: <?php echo $gender; ?></h3>
                                      <h3>Address: <?php echo $address; ?></h3>
                                      <h3>birthdate: <?php echo $birthdate; ?></h3>
                                      <a href="update_data.php?id=<?php echo $id; ?>" class="btn btn-success"> Edit </a> <a href="delete_data.php?id=<?php echo $id; ?>" class="btn btn-danger"> Delete </a> 
                                    </div>
                                  </div>
                                </td>
                                </tr>
                              <?php
                              $slno=$slno+1;
                              }        
                            }
                          ?>
                        
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>