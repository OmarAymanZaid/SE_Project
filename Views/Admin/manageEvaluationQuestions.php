<?php

require_once '../../Models/admin.php';
require_once '../../Controllers/SessionController.php';
require_once '../../Controllers/ConstantsController.php';
require_once '../../Controllers/CourseController.php';
require_once '../../Controllers/AuthController.php';


// $userRole              = "admin";
// $auth                  = new AuthController;    
// $auth->redirectIfUnathuorized($userRole);

if(!isSessionStarted())
{
    session_start();
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



    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>