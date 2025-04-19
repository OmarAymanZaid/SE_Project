<?php

require_once '../../Models/admin.php';
require_once '../../Controllers/SessionController.php';
require_once '../../Controllers/ConstantsController.php';
require_once '../../Controllers/CourseController.php';
require_once '../../Controllers/AuthController.php';


if(!isSessionStarted())
{
    session_start();
}

$userRole              = "admin";
$auth                  = new AuthController;    
$auth->redirectIfUnathuorized($userRole);



$courseController = new CourseController;
$delMsg = "";

if(isset($_POST['delete']))
{
    if($courseController->deleteCourse($_POST['courseID']))
    {
        $deleteMsg = true;
    }
}

$courses = $courseController->getAllCourses();

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

        <div class="card-body">
            
            <?php if(count($courses) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Courses Available</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Courses</h3>
                <div class="row">
                <?php foreach($courses as $course): ?>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card mb-3" style="margin:10px; padding:10px;">
                            <img class="img-fluid card-img-top" src="<?= $course['image'] ?>"
                                alt="Card image cap" style="border: 0.8px grey solid">
                            <div class="card-body">
                                <h5 class="card-title"> <?= $course['name'] ?> </h5>
                                <p class="card-text"> <?= $course['description'] ?> </p>

                                <form action="manageCourses.php" method="post">
                                        <input type="hidden" name="courseID" value="<?php echo $course["ID"] ?>">
                                        <button type="submit" class="btn btn-outline-danger" name="delete"><i class='fas fa-trash-alt' style="margin-right: 6px;"></i>Delete</button>
                                </form>    

                                <?php $_SESSION['courseIDForAssignCourse'] = $course["ID"]; ?>
                                <a href="assignCourseToTeacher.php" class="btn btn-outline-primary" style="margin-top:10px" name="submit">
                                    <i class="ti ti-book" style="margin-right: 6px;"></i>Assign
                                </a>
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
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                            <?php echo $delMsg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div style="padding:10px;">
            <a class="btn btn-primary" href="addCourse.php" role="button">Add New Course</a>
        </div>

    </div>


    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>