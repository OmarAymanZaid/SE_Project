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


    $userRole              = "student";
    $auth                  = new AuthController;    
    $auth->redirectIfUnathuorized($userRole);


    if(isset($_POST['logout']))
    {
        $auth->logout();
    }

    $msg = "";

    if(isset($_GET["courseID"]))
    {
        $courseID = $_GET["courseID"];
        $courseName = $_GET["courseName"];
    }

    if (isset($_POST["uploadAssignment"])) 
    {

    
        $student = new Student;

        $location = "../files/assignments/"  . date("h-i-s") . " " . $_FILES["assignment"]["name"];

        if (move_uploaded_file($_FILES["assignment"]["tmp_name"], $location))
        {
          if ($student->uploadAssignment($_SESSION['userID'],$_POST['courseID'] ,$_FILES["assignment"]["name"] ,$location)) 
          {
              $msg = "Uploaded Successfully !";
          } 
          else 
          {
              $msg = "Something went wrong... try again";
          }
        } 
    }

    $courseController = new CourseController;
    $courses = $courseController->getCoursesEnrolledByStudent($_SESSION["userID"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Edusmarto</title>
    <?php include '../reusable/reusableHeader.php'; ?>

</head>

<body>

    <?php include 'navStudent.php'; ?>

    <?php include 'studentHeader.php'; ?>

    <div class="pc-container">

    <div class="card-body" style="padding:15px">
            <form class="card-body" action="uploadAssignment.php" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12">
                    <div class="card">
                        <input type="hidden" name="courseID" value="<?=$courseID?>">
                        <input type="hidden" name="courseName" value="<?=$courseName?>">
                        <div class="card-header">
                            <h5>Upload Assignment</h5>
                        </div>

                        <div class="card-body">
                            <div class="fallback">
                                <input name="assignment" type="file" multiple>
                            </div>
                        </div>
                    </div>
                </div>


                    <?php
                    
                    if($msg)
                    {
                        ?>
                            <div class="row mb-3">
                                <div class="offset-sm-3 col-sm-6">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                                        <?php echo $msg; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary" name="uploadAssignment"> Add </button>
                    </div>
            </form>
        </div>

    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>

</body>
</html>