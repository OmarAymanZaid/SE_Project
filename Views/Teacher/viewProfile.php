<?php

    require_once '../../Models/student.php';
    require_once '../../Controllers/SessionController.php';
    require_once '../../Controllers/ConstantsController.php';
    require_once '../../Controllers/CourseController.php';
    require_once '../../Controllers/AuthController.php';


    if(!isSessionStarted())
    {
        session_start();
    }


    $userRole              = "teacher";
    $auth                  = new AuthController;    
    $auth->redirectIfUnathuorized($userRole);


    $msg = "";

    if (isset($_POST["editName"]) && isset($_POST["userName"])) 
    {
        $user = new User;

        if ($user->editUsername($_POST["userID"], $_POST["userName"])) 
        {
            $msg = "Edited Successfully! Please login again.";
        }
    }


    if (isset($_POST["editPicture"])) 
    {
        $user = new User;

        $location = "../images/"  . date("h-i-s") . $_FILES["profileImage"]["name"];

        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $location))
        {
          if ($user->editProfilePicture($_POST['userID'] ,$location)) 
          {
              $msg = "Edited Successfully! Please login again.";
          } 
          else 
          {
              $msg = "Something went wrong... try again";
          }
        } 
    }


    if(isset($_POST['logout']))
    {
        $auth->logout();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Edusmarto</title>
    <?php include '../reusable/reusableHeader.php'; ?>

</head>

<body>

    <?php include 'navTeacher.php'; ?>

    <?php include '../reusable/actualReusableHeader.php'; ?>

    <div class="pc-container">


    <div class="row" style="padding: 25px; margin: 0 15px; border: 2px grey solid;">
        <div class="col-md-6 col-xxl-4 d-flex" style="width: 100%">

            <div style="width: 25%">
                <img class="img-fluid card-img-top" src="<?=$_SESSION["userImage"]?>"
                alt="Card image cap" style="border: 0.8px grey solid">
            </div>

            <div class="card-body" style="margin: 15px; width: 100%;">
                <h1 class="card-title"> <?=$_SESSION['userName']?> </h1>
                <br>
                <h4 class="card-text"> <?=$_SESSION['userRole']?> </h4> 
                <h4 class="card-text"> <?=$_SESSION['userEmail']?> </h4>
             
                <div class="d-flex">
                    <button class="btn btn-outline-primary" name="drop" style="display: inline-block;" onclick="openNewNameForm()">
                        Edit Name
                    </button>  

                    <button class="btn btn-outline-primary" name="drop" style="margin-left: 8px; display: inline-block;" onclick="openNewPictureForm()">
                        Edit Picture
                    </button>  
                </div>


                <form id="editNameForm" action="viewProfile.php" method="post" style="margin-top: 14px; display: none;">
                        <input type="hidden" name="userID" value="<?=$_SESSION['userID']?>">
                        <input type="text" name="userName">
                        <button type="submit" class="btn btn-primary" name="editName">Edit</button>
                </form>

                <form id="editPictureForm" action="viewProfile.php" method="post" style="margin-top: 14px; padding-left: 5px; display: none;" enctype="multipart/form-data">
                      <input type="hidden" name="userID" value="<?=$_SESSION['userID']?>">
                      <input name="profileImage" type="file" multiple>
                      <button type="submit" class="btn btn-primary" name="editPicture">Change Picture</button>
                </form>

            </div>


        </div>
    </div>

    <?php if($msg): ?>
        <div class="row mb-3" style="margin-top: 10px">
            <div class="offset-sm-3 col-sm-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>


    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>
    
    <script>        
        function openNewNameForm()
        {
            document.getElementById('editNameForm').style.display = "inline-block";
        }

        function openNewPictureForm()
        {
            document.getElementById('editPictureForm').style.display = "inline-block";
        }
    </script>

</body>
</html>