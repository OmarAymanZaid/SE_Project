<?php

require_once '../../Models/admin.php';
require_once '../../Models/notification.php';
require_once '../../Models/evaluationQuestion.php';
require_once '../../Controllers/SessionController.php';
require_once '../../Controllers/ConstantsController.php';
require_once '../../Controllers/NotificationsController.php';
require_once '../../Controllers/AuthController.php';

if(!isSessionStarted())
{
    session_start();
}

$userRole              = "admin";
$auth                  = new AuthController;    
$auth->redirectIfUnathuorized($userRole);

$errMsg = "" ;

if(isset($_GET['userID']))
{
    $userID = $_GET['userID'];
}

if(isset($_POST['notification']))
{
    if(!empty($_POST['notification']))
    {
        $notificationsController    = new NotificationsController;
        $notification = new Notification;
    
        $notification->setUserID($_POST['userIDToNotify']);
        $notification->setNotificationText($_POST['notification']);
    
        if($notificationsController->addNotification($notification))
        {
            header("location: index.php");
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

    <title>Admin</title>
    <?php include '../reusable/reusableHeader.php'; ?>

</head>
<body>

    <?php include 'navAdmin.php'; ?>

    <?php include '../reusable/actualReusableHeader.php'; ?>


    <div class="pc-container">
        <div class="container">
            <form class="card-body" action="notify.php" method="POST" style="padding:18px;">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Add Notification</b></h3>
                </div>

                <div class="form-group mb-3">
                    <input type="hidden" class="form-control" name="userIDToNotify" value="<?=$userID?>">
                    <input type="text" class="form-control" placeholder="notification..." name="notification">
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
                    <button type="submit" class="btn btn-primary" name="submit"> Add </button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>