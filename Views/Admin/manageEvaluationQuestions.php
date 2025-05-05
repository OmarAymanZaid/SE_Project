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
        $evaluationQuestions = $questionsController->getQuestions();
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

                <div style="padding:10px;">
                    <a href="addEvaluationQuestion.php" class="btn btn-primary">Add</a>
                </div>
            
            <?php else: ?>
                <h3 style="padding:10px;">Question</h3>

                <div style="padding:10px;">
                    <a href="addEvaluationQuestion.php" class="btn btn-primary">Add</a>
                </div>

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
                                        <form action="manageEvaluationQuestions.php" method="post">
                                            <input type="hidden" name="questionID" value="<?php echo $evaluationQuestion["ID"] ?>">
                                            <button type="submit" class="btn btn-outline-danger" name="delete"><i class='fas fa-trash-alt' style="margin-right: 6px;"></i>Delete</button>
                                        </form>                   
                                    </td>
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



    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>