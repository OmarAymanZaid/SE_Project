<?php

    require_once '../../Models/user.php';
    require_once '../../Controllers/SessionController.php';
    require_once '../../Controllers/ConstantsController.php';
    require_once '../../Controllers/UsersController.php';
    require_once '../../Controllers/CourseController.php';
    require_once '../../Controllers/AuthController.php';


    if(!isSessionStarted())
    {
        session_start();
    }


    $userRole              = "student";
    $auth                  = new AuthController;    
    $auth->redirectIfUnathuorized($userRole);


    $msg = "";

    if (isset($_GET["userProfileID"])) 
    {
        $usersController = new UsersController;

        $userData = $usersController->getUser($_GET["userProfileID"]);
        
        $userRole = "";
        if($userData[0]['roleID'] == ADMIN_ROLE)
        {
            $userRole = "admin";
        }
        elseif($userData[0]['roleID'] == STUDENT_ROLE)
        {
            $userRole = "student";
        }
        else
        {
            $userRole = "teacher";
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

    <?php include 'navStudent.php'; ?>

    <?php include 'studentHeader.php'; ?>

    <div class="pc-container">


    <div class="row" style="padding: 25px; margin: 0 15px; border: 2px grey solid;">
        <div class="col-md-6 col-xxl-4 d-flex" style="width: 100%">

            <div style="width: 25%">
                <img class="img-fluid card-img-top" src="<?=$userData[0]["image"]?>"
                alt="Card image cap" style="border: 0.8px grey solid">
            </div>

            <div class="card-body" style="margin: 15px; width: 100%;">
                <h1 class="card-title"> <?=$userData[0]['name']?> </h1>
                <br>
                <h4 class="card-text"> <?=$userRole?> </h4> 
                <h4 class="card-text"> <?=$userData[0]['email']?> </h4> 

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
    

</body>
</html>