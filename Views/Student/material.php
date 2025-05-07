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


    $userRole              = "student";
    $auth                  = new AuthController;    
    $auth->redirectIfUnathuorized($userRole);




    if(isset($_POST['logout']))
    {
        $auth->logout();
    }

    $courseController = new CourseController;
    $materials = $courseController->getCourseMaterial($_GET['courseID']);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Edusmarto</title>
    <?php include '../reusable/reusableHeader.php'; ?>

</head>

<body>

    <?php include 'navStudent.php'; ?>

    <?php include '../reusable/actualReusableHeader.php'; ?>

    <div class="pc-container">

        <div class="card-body">
            
            <?php if(count($materials) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Material Available</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Material</h3>
                <div class="dt-responsive table-responsive">
                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap" style="text-align:center;">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            foreach($materials as $material)
                            {
                            ?>
                                <tr>
                                    <td><?php echo $material['name']; ?></td>
                                    <td>
                                        <a href="<?= $material['location'] ?>" download class="btn btn-primary">
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