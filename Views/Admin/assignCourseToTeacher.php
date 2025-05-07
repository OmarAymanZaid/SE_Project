<?php

require_once '../../Models/admin.php';
require_once '../../Controllers/SessionController.php';
require_once '../../Controllers/ConstantsController.php';
require_once '../../Controllers/CourseController.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/UsersController.php';


if(!isSessionStarted())
{
    session_start();
}

$userRole              = "admin";
$auth                  = new AuthController;    
$auth->redirectIfUnathuorized($userRole);

$msg = "" ;

if(isset($_POST['assignCourse']))
{
    $courseController = new CourseController;
    if($courseController->assignCourseToTeacher($_POST['userID'], $_SESSION['courseIDForAssignCourse']))
    {
        $msg = "Course Assigned Successfully !";
    }
}

$usersController = new UsersController;
$users = $usersController->getAllTeachers();


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
            
            <?php if(count($users) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Teachers Available</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Teachers</h3>

                <div class="dt-responsive table-responsive">
                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap" style="text-align:center;">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            foreach($users as $user)
                            {
                            ?>
                                <tr>
                                    <td><?php echo $user['ID']; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td>
                                        <form action="assignCourseToTeacher.php" method="post">
                                            <input type="hidden" name="userID" value="<?php echo $user["ID"] ?>">
                                            <button type="submit" class="btn btn-outline-primary" name="assignCourse" value="assign">
                                                <i class='ti ti-book' style="margin-right: 6px;"></i> Assign
                                            </button>
                                        </form>                   
                                    </td>
                                </tr>
                            <?php
                            }
                        
                        ?>
                    </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

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




    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>