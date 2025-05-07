<?php

require_once '../../Models/teacher.php';
require_once '../../Models/announcement.php';
require_once '../../Controllers/NotificationsController.php';
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

$errMsg = "" ;

if(isset($_GET['courseID']))
{
    $courseID = $_GET['courseID'];
}

if(isset($_POST['announcement']))
{
    if(!empty($_POST['announcement']))
    {
        $notificationsController    = new NotificationsController;
        $announcement = new Announcement;
    
        $announcement->setCourseID($_POST['courseID']);
        $announcement->setAnnouncementText($_POST['announcement']);
    
        if($notificationsController->sendAnnouncement($announcement))
        {
            header("location: material.php");
        }
    }
    else
    {
        $errMsg = "Please Fill In All The Fields" ;
    }

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
        <div class="container">
            <form class="card-body" action="sendAnnouncements.php" method="POST" style="padding:18px;">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Send Announcements</b></h3>
                </div>

                <div class="form-group mb-3">
                    <input type="hidden" class="form-control" name="courseID" value = "<?= $courseID ?>">
                    <input type="text" class="form-control" placeholder="announcement..." name="announcement">
                </div>

                <?php
                
                if($errMsg)
                {
                    ?>
                        <div class="row mb-3">
                            <div class="offset-sm-3 col-sm-6">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                                    <?php echo $errMsg; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>

                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary" name="submit"> Send </button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>