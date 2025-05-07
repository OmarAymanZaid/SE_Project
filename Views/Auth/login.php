<?php

require_once '../../Models/user.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/ConstantsController.php';

$errMsg = "";

if(isset($_POST['email']) && isset($_POST['password']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        $user = new User;
        $auth = new AuthController;

        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        
        if(!$auth->login($user))
        {
            $errMsg = $_SESSION['errMsg'];
        }
        else
        {
            if($_SESSION['userRole'] == 'admin')
            {
                header("location: ../Admin/index.php");
            }
            else if($_SESSION['userRole'] == 'student')
            {
                header("location: ../Student/index.php");
            }
            else
            {
              header("location: ../Teacher/index.php");
            }
        }

    }
    else
    {
        $errMsg = "Please Fill In All Fields";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Login</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Fancy Learning ? come with us !">
  <?php include '../reusable/reusableHeader.php'; ?>

</head>

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">

        <div class="auth-header">
          <a href="#"><img src="../assets/images/edusmarto-logo2_2.png" alt="img"></a>
        </div>


        <div class="card my-5">

          <form class="card-body" action="login.php" method="POST">

            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Login</b></h3>
              <a href="register.php" class="link-primary">Don't have an account?</a>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" name="email">
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>

            <?php
            
              if($errMsg)
              {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                        <?php echo $errMsg; $errMsg=""; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
              }
            
            ?>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary" name="submit">Login</button>
            </div>
          </form>

        </div>

        <div class="auth-footer row">
          <!-- <div class=""> -->
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Contact us</a></li>
              </ul>
            </div>
          <!-- </div> -->
        </div>

      </div>
    </div>
  </div>

  <?php include '../reusable/javascriptFiles.php'; ?>
    
 
</body>

</html>