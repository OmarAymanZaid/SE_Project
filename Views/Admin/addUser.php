<?php

  require_once '../../Controllers/SessionController.php';
  require_once '../../Controllers/AuthController.php';
  require_once '../../Controllers/ConstantsController.php';
  require_once '../../Models/user.php';


  if(!isSessionStarted())
  {
      start_session();
  }


  $errMsg = '';
  $sucMsg = '';

//   $userRole              = "admin";
//   $auth                  = new AuthController;    
//   $auth->redirectIfUnathuorized($userRole);



  if(isset($_POST['submit']))
  {
      if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']))
      {
          $user = new User;
          $auth = new AuthController;


          $user->name = $_POST['name'];
          $user->email = $_POST['email'];
          $user->password = $_POST['password'];

          if($_POST['role'] == 'admin')
            $user->roleID = ADMIN_ROLE;
          elseif($_POST['role'] == 'student')
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

    <title>Admin | add user</title>
    <?php include '../reusable/reusableHeader.php'; ?>

</head>

<body>

    <?php include 'navAdmin.php'; ?>

    <div class="pc-container">
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
                        <label class="form-label">Admin</label>
                        <input type="radio" name="role" value="admin">
                    </span>
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
                            <div class="row mb-3">
                                <div class="offset-sm-3 col-sm-6">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                                        <?php echo $errMsg; $errMsg=""; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
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

    <?php include '../reusable/javascriptFiles.php'; ?>

</body>
</html>