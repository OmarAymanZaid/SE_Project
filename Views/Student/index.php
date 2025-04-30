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

    $delMsg = false;
    if (isset($_POST["drop"])) 
    {
        $student = new Student;

        if ($student->dropCourse($_POST["courseID"], $_SESSION["userID"])) 
        {
            $delMsg = "Course Dropped Successfully!";
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

        <div class="card-body">
            
            <?php if(count($courses) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Enrolled Courses</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Enrolled Courses</h3>
                <div class="row">
                <?php foreach($courses as $course): ?>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card mb-3" style="margin:10px; padding:10px;">
                            <img class="img-fluid card-img-top" src="<?= $course['image'] ?>"
                                alt="Card image cap" style="border: 0.8px grey solid">
                            <div class="card-body">
                                <h5 class="card-title"> <?= $course['name'] ?> </h5>
                                <p class="card-text"> <?= $course['description'] ?> </p>

                                <a href="material.php?courseID=<?=$course['ID']?>" class="btn btn-outline-primary">
                                    <i class='fas fa-trash-alt' style="margin-right: 6px;"></i> Material
                                </a>


                                <form action="index.php" method="post" style="margin-left: 5px; display: inline-block;">
                                        <input type="hidden" name="courseID" value="<?php echo $course["ID"] ?>">
                                        <button type="submit" class="btn btn-outline-danger" name="drop"><i class='fas fa-trash-alt' style="margin-right: 6px;"></i>Drop</button>
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
            <a class="btn btn-primary" href="enrollInCourses.php" role="button">Discover More Courses</a>
        </div>

    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>

</body>
</html>