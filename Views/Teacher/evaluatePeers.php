<?php

    require_once '../../Models/student.php';
    require_once '../../Controllers/SessionController.php';
    require_once '../../Controllers/ConstantsController.php';
    require_once '../../Controllers/UsersController.php';
    require_once '../../Controllers/AuthController.php';


    if(!isSessionStarted())
    {
        session_start();
    }


    $userRole              = "teacher";
    $auth                  = new AuthController;    
    $auth->redirectIfUnathuorized($userRole);


    if(isset($_POST['logout']))
    {
        $auth->logout();
    }

    $msg = false;

    $userController = new UsersController;
    $teachers = $userController->getAllTeachersExcept($_SESSION['userID']);


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

        <div class="card-body" style="margin-left: 12px">
            
            <?php if(count($teachers) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Available Teachers</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Teachers</h3>
                <div class="row">
                <?php foreach($teachers as $teacher): ?>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card mb-3" style="margin:10px; padding:10px;">
                            <img class="img-fluid card-img-top" src="../images/anonymousIcon.jpg" alt="Card image cap" style="border: 0.8px grey solid">
                            <div class="card-body">
                                <h5 class="card-title"> <?= $teacher['name'] ?> </h5>

                                <?php $_SESSION['teacherIDToEvaluate'] = $teacher['ID'] ?>
                                <a href="evaluationForm.php" class="btn btn-outline-primary">
                                    <i class='ti ti-star' style="margin-right: 6px;"></i>Evaluate
                                </a>

                                <a href="viewTeacherProfile.php" class="btn btn-outline-primary">
                                    <i class='ti ti-user' style="margin-right: 6px;"></i>  Profile
                                </a>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <?php endif;?>

        </div>

        <?php if($msg): ?>
            <div class="row mb-3">
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