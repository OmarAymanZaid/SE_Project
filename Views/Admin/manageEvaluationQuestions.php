<?php

require_once '../../Models/admin.php';
require_once '../../Controllers/SessionController.php';
require_once '../../Controllers/ConstantsController.php';
require_once '../../Controllers/CourseController.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/QuestionsController.php';


if(!isSessionStarted())
{
    session_start();
}

$userRole              = "admin";
$auth                  = new AuthController;    
$auth->redirectIfUnathuorized($userRole);

$deleteMsg = '';
$admin = new Admin;
$questionsController = new QuestionsController;

if (isset($_POST["delete"])) 
{
    if (!empty($_POST["questionID"])) 
    {
      if ($admin->deleteQuestion($_POST["questionID"])) 
      {
        $deleteMsg = true;
        $evaluationQuestions = $admin->getQuestions();
      }
    }
}


$evaluationQuestions = $questionsController->getQuestions();


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
            
            <?php if(count($evaluationQuestions) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Questions Available</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Question</h3>
                <div class="dt-responsive table-responsive">
                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap" style="text-align:center;">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Text</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            foreach($evaluationQuestions as $evaluationQuestion)
                            {
                            ?>
                                <tr>
                                    <td><?php echo $evaluationQuestion['ID']; ?></td>
                                    <td><?php echo $evaluationQuestion['questionText']; ?></td>
                                    <td>
                                        <form action="manageEvaluationQuestion.php" method="post">
                                            <input type="hidden" name="questionID" value="<?php echo $evaluationQuestion["ID"] ?>">
                                            <button type="submit" class="btn btn-outline-danger" name="delete"><i class='fas fa-trash-alt' style="margin-right: 6px;"></i>Delete</button>
                                        </form>                   
                                    </td>

                                    <!-- <td>

                                        <button type="button" class="btn btn-outline-primary" onclick="openEditForm(<?=$evaluationQuestion["ID"];?>)">
                                            <i class="fas fa-edit"></i>Edit
                                        </button>

                                        <div class="justify-content-center container" style="border: 1px gray solid; margin-top:15px; padding: 15px; display:none;" id="editForm-<?=$user['ID'];?>">
                                            <form action="index.php" method="post">
                                                <h2>Edit User Role</h2>
                                                <div class="container">
                                                    <div>
                                                        <label class="form-label">Admin</label>
                                                        <input type="radio" name="role" value="admin">
                                                    </div>
                                                    <div>
                                                        <label class="form-label">Student</label>
                                                        <input type="radio" name="role" value="student">
                                                    </div>
                                                    <div>
                                                        <label class="form-label">Teacher</label>
                                                        <input type="radio" name="role" value="teacher">
                                                    </div>
                                                </div>
                                                <input type="hidden" value = "<?=$user['ID'];?>" name="userID">
                                                <button type="submit" class="btn btn-outline-danger" name="editRole">
                                                    Edit
                                                </button>
                                            </form>                   
                                        </div>
                                    </td> -->
                                </tr>
                            <?php
                            }
                        
                        ?>
                    </tbody>
                    </table>

                    <?php
                        if($deleteMsg)
                        {
                            ?>
                                <div class="row mb-3">
                                    <div class="offset-sm-3 col-sm-6">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                                            <?php echo 'User deleted successfully !'; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>

                </div>
            </div>

        <?php endif;?>

        <div style="padding:10px;">
        <a href="addEvaluationQuestion.php" class="btn btn-outline-primary">Add</a>
         </div>

    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>