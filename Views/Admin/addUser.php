<?php

  require_once '../../Controllers/SessionController.php';
  require_once '../../Controllers/AuthController.php';
  require_once '../../Controllers/ConstantsController.php';
  require_once '../../Models/user.php';

  $errMsg = '';
  $sucMsg = '';

  if(!isSessionStarted())
  {
      start_session();
  }


  if(isset($_POST['submit']))
  {
      if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']))
      {
          $user = new User;
          $auth = new AuthController;


          $user->name = $_POST['name'];
          $user->email = $_POST['email'];
          $user->password = $_POST['password'];

          if($_POST['role'] == 'student')
            $user->roleID = STUDENT_ROLE;
          else
            $user->roleID = TEACHER_ROLE;


          if(!$auth->register($user))
          {
              $errMsg = $_SESSION['errMsg'];
          }
          else
          {
                $sucMsg = "User Added Successfully";
                header("location: index.php");
          }

      }
      else
      {
          $errMsg = 'please fill in all fields';
          
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>

    
    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="../assets/fonts/feather.css" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css" >
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/material.css" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" >
    <link rel="stylesheet" href="../assets/css/style-preset.css" >
</head>

<body>
    <div class="container">
        <div class="card my-5">
            <form class="card-body" action="addUser.php" method="POST">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Add New User</b></h3>
                    </div>

                    <div class="form-group mb-3">
                    <label class="form-label">Name*</label>
                    <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>

                    <div class="form-group mb-3">
                    <label class="form-label">Email Address*</label>
                    <input type="email" class="form-control" placeholder="Email Address" name="email">
                    </div>

                    <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>

                    <div class="form-group mb-3 d-flex justify-content-evenly align-items-center">
                    <span>
                        <label class="form-label">Student</label>
                        <input type="radio" name="role" value="student">
                    </span>
                    <span>
                        <label class="form-label">Teacher</label>
                        <input type="radio" name="role" value="teacher">
                    </span>
                    </div>

                    <?php
                    
                    if($errMsg)
                    {
                        ?>
                        <div class="alert alert-danger" role="alert"> 
                            <?php echo $errMsg; $errMsg=""; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                    else if($sucMsg)
                    {
                        ?>
                        <div class="alert alert-success" role="alert"> 
                            <?php echo $sucMsg; $errMsg="";?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                    
                    ?>

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary" name="submit"> Add </button>
                    </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/plugins/bootstrap.min.js"></script>
</body>
</html>