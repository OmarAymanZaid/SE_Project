<?php

    require_once '../../Models/teacher.php';
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


    if(isset($_POST['logout']))
    {
        $auth->logout();
    }

    $delMsg = false;
    if (isset($_POST["cancel"])) 
    {
        $teacher = new Teacher;

        if ($teacher->cancelCourse($_POST["courseID"], $_SESSION["userID"])) 
        {
            $delMsg = "Course Cancelled Successfully!";
        }
    }

    $courseController = new CourseController;
    $courses = $courseController->getCoursesAssignedToTeacher($_SESSION["userID"]);


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

        <div class="card-body">
            
            <?php if(count($courses) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Assigned Courses</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Assigned Courses</h3>
                <div class="row">
                <?php foreach($courses as $course): ?>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card mb-3" style="margin:10px; padding:10px;">
                            <img class="img-fluid card-img-top" src="<?= $course['image'] ?>"
                                alt="Card image cap" style="border: 0.8px grey solid">
                            <div class="card-body">
                                <h5 class="card-title"> <?= $course['name'] ?> </h5>
                                <p class="card-text"> <?= $course['description'] ?> </p>

                                <form action="index.php" method="post">
                                        <input type="hidden" name="courseID" value="<?php echo $course["ID"] ?>">
                                        <button type="submit" class="btn btn-outline-danger" name="cancel"><i class='fas fa-trash-alt' style="margin-right: 6px;"></i>Cancel</button>
                                </form>
                                

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <?php endif;?>

        </div>

        <?php if($delMsg): ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                            <?php echo $delMsg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div style="padding:10px;">
            <a class="btn btn-primary" href="assignForCourses.php" role="button">Discover More Courses</a>
        </div>

    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>

</body>
</html>