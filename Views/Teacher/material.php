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


    $userRole              = "teacher";
    $auth                  = new AuthController;    
    $auth->redirectIfUnathuorized($userRole);




    if(isset($_POST['logout']))
    {
        $auth->logout();
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
                <h2 class="container" style="padding-top: 15px;">No courses Available</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">courses</h3>
                <div class="dt-responsive table-responsive">
                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap" style="text-align:center;">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            foreach($courses as $course)
                            {
                            ?>
                                <tr>
                                    <td><?php echo $course['ID']; ?></td>
                                    <td><?php echo $course['name']; ?></td>
                                    <td><?php echo $course['description']; ?></td>

                                    <td>
                                        <a href="uploadCourseMaterial.php?courseID=<?= $course['ID']?>&courseName=<?=$course['name']?>" class="btn btn-outline-primary">
                                            Upload
                                        </a>
                                    </td>

                                    <td>
                                        <a href="sendAnnouncements.php?courseID=<?= $course['ID']?>" class="btn btn-outline-success">
                                            announce
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        
                        ?>
                    </tbody>
                    </table>

                </div>
            </div>

        <?php endif;?>

    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>

</body>
</html>