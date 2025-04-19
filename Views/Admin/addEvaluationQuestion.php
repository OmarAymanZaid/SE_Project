<?php

require_once '../../Models/admin.php';
require_once '../../Models/evaluationQuestion.php';
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

$errMsg = "" ;

if(isset($_POST['questionText']))
{
    if(!empty($_POST['questionText']))
    {
        $admin    = new Admin;
        $question = new EvaluationQuestion;
    
        $question->questionText = $_POST['questionText'];
    
        if($admin->addEvaluationQuestion($question))
        {
            header("location: manageEvaluationQuestions.php");
        }
    }
    else
    {
        $errMsg = "Please Fill In All The Fields" ;
    }

}



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
        <div class="card my-5">
            <form class="card-body" action="addEvaluationQuestion.php" method="POST">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Add New Evaluation Question</b></h3>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Question Text</label>
                    <input type="text" class="form-control" placeholder="Question..." name="questionText">
                </div>

                <?php
                
                if($errMsg)
                {
                    ?>
                        <div class="row mb-3">
                            <div class="offset-sm-3 col-sm-6">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                                    <?php echo $errMsg; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>

                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary" name="submit"> Add </button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>