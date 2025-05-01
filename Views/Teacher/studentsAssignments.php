<?php

    require_once '../../Models/admin.php';
    require_once '../../Controllers/SessionController.php';
    require_once '../../Controllers/ConstantsController.php';
    require_once '../../Controllers/CourseController.php';
    require_once '../../Controllers/FileController.php';
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

    $fileController = new FileController;
    $assignments = $fileController->getCourseAssignments($_GET['courseID']);

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
            
            <?php if(count($assignments) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Assignments Available</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Students Assignments</h3>
                <div class="dt-responsive table-responsive">
                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap" style="text-align:center;">
                    <thead>
                        <tr>
                        <th>Sent By</th>
                        <th>Name</th>
                        <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            foreach($assignments as $assignment)
                            {
                            ?>
                                <tr>
                                    <td><?php echo $assignment['sentBy']; ?></td>
                                    <td><?php echo $assignment['name']; ?></td>
                                    <td>
                                        <a href="<?= $assignment['location'] ?>" download class="btn btn-primary">
                                            download
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