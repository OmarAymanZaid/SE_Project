<?php

  require_once '../../Controllers/SessionController.php';
  require_once '../../Controllers/AuthController.php';
  require_once '../../Controllers/ConstantsController.php';
  require_once '../../Models/user.php';

  $errMsg = '';

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


          $name     = $user->setName($_POST['name']);
          $email    = $user->setEmail($_POST['email']);
          $password = $user->setPassword($_POST['password']);
          $image    = $user->setImage("../images/anonymousIcon.jpg");

          if($_POST['role'] == 'student')
          $user->setRoleID(STUDENT_ROLE);
          else
          $user->setRoleID(TEACHER_ROLE);


          if(!$auth->register($user))
          {
              $errMsg = $_SESSION['errMsg'];
          }
          else
          {
              if($_SESSION['userRole'] == 'student')
                header("location:../Student/index.php");
              else
               header("location:../Teacher/index.php ");
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

<!-- [Head] start -->
<head>

  <title>Register</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
          <a href="#"><img src="../assets/images/logo-dark.svg" alt="img"></a>
        </div>

        <div class="card my-5">
          <form class="card-body" action="register.php" method="POST">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Sign up</b></h3>
              <a href="login.php" class="link-primary">Already have an account?</a>
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
                  <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                      <?php echo $errMsg; $errMsg=""; ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php
              }
            
            ?>

            <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary"> Terms of Service </a> and <a href="#" class="text-primary"> Privacy Policy</a></p>
            <div class="d-grid mt-3">
              <button type="submit" class="btn btn-primary" name="submit">Create Account</button>
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
    
 <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">

  <div class="offcanvas-header bg-primary">
    <h5 class="offcanvas-title text-white">Mantis Customizer</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="pct-body" style="height: calc(100% - 60px)">

    <div class="offcanvas-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse1">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-layout-sidebar f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Layout</h6>
                <span>Choose your layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse1">
            <div class="pct-content">
              <div class="pc-rtl">
                <p class="mb-1">Direction</p>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="layoutmodertl">
                  <label class="form-check-label" for="layoutmodertl">RTL</label>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse2">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-brush f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Mode</h6>
                <span>Choose light or dark mode</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse2">
            <div class="pct-content">
              <div class="theme-color themepreset-color theme-layout">
                <a href="#!" class="active" onclick="layout_change('light')" data-value="false"
                  ><span><img src="../assets/images/customization/default.svg" alt="img"></span><span>Light</span></a
                >
                <a href="#!" class="" onclick="layout_change('dark')" data-value="true"
                  ><span><img src="../assets/images/customization/dark.svg" alt="img"></span><span>Dark</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse3">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-color-swatch f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Color Scheme</h6>
                <span>Choose your primary theme color</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse3">
            <div class="pct-content">
              <div class="theme-color preset-color">
                <a href="#!" class="active" data-value="preset-1"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 1</span></a
                >
                <a href="#!" class="" data-value="preset-2"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 2</span></a
                >
                <a href="#!" class="" data-value="preset-3"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 3</span></a
                >
                <a href="#!" class="" data-value="preset-4"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 4</span></a
                >
                <a href="#!" class="" data-value="preset-5"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 5</span></a
                >
                <a href="#!" class="" data-value="preset-6"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 6</span></a
                >
                <a href="#!" class="" data-value="preset-7"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 7</span></a
                >
                <a href="#!" class="" data-value="preset-8"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 8</span></a
                >
                <a href="#!" class="" data-value="preset-9"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 9</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item pc-boxcontainer">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse4">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-border-inner f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Layout Width</h6>
                <span>Choose fluid or container layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse4">
            <div class="pct-content">
              <div class="theme-color themepreset-color boxwidthpreset theme-container">
                <a href="#!" class="active" onclick="change_box_container('false')" data-value="false"><span><img src="../assets/images/customization/default.svg" alt="img"></span><span>Fluid</span></a>
                <a href="#!" class="" onclick="change_box_container('true')" data-value="true"><span><img src="../assets/images/customization/container.svg" alt="img"></span><span>Container</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse5">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-typography f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Font Family</h6>
                <span>Choose your font family.</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse5">
            <div class="pct-content">
              <div class="theme-color fontpreset-color">
                <a href="#!" class="active" onclick="font_change('Public-Sans')" data-value="Public-Sans"
                  ><span>Aa</span><span>Public Sans</span></a
                >
                <a href="#!" class="" onclick="font_change('Roboto')" data-value="Roboto"><span>Aa</span><span>Roboto</span></a>
                <a href="#!" class="" onclick="font_change('Poppins')" data-value="Poppins"><span>Aa</span><span>Poppins</span></a>
                <a href="#!" class="" onclick="font_change('Inter')" data-value="Inter"><span>Aa</span><span>Inter</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="collapse show">
            <div class="pct-content">
              <div class="d-grid">
                <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>

  </div>

</div>


</body>

</html>