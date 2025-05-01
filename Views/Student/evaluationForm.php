<?php

  require_once '../../Controllers/SessionController.php';
  require_once '../../Controllers/AuthController.php';
  require_once '../../Controllers/ConstantsController.php';
  require_once '../../Controllers/QuestionsController.php';
  require_once '../../Models/user.php';
  require_once '../../Models/admin.php';


  if(!isSessionStarted())
  {
      start_session();
  }


  $errMsg = '';
  $sucMsg = '';

  $userRole              = "student";
  $auth                  = new AuthController;    
  $auth->redirectIfUnathuorized($userRole);


  $questionsController = new QuestionsController;
  $questions = $questionsController->getQuestions();


  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
  {
    $resposnes = [];
    
    $questionsCount = count($questions);
    for($i = 1; $i<$questionsCount; $i++)
    {
        $fieldName = "question" . $i;

        if(!isset($_POST[$fieldName]))
        {
            $errMsg = "Please Answer All Questions";
            break;
        }

        $response = $_POST[$fieldName];
        if($questionsController->insertEvaluationResponse($_POST['questionID'], $_SESSION['teacherIDToEvaluate'], $response))
        {
            header("Location: evaluateTeachers.php");
        }

    }

  }



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
        <div class="card-body" style="padding:15px">
            <form class="card-body" action="evaluationForm.php" method="POST">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h2 class="mb-0"><b>Evaluate Teacher</b></h2>
                </div>

                <?php $i = 1; foreach($questions as $question): ?>
                    <div style="padding: 15px; border: 1px grey solid;">
                        <p style="font-size: 20px"><?=$i?> . <?=$question["questionText"]?></p>
                        <input type="hidden" name="questionID" value="<?=$question["ID"]?>">
                        <div class="form-group mb-3 d-flex justify-content-evenly align-items-center">
                            <span>
                                <label class="form-label">Strongly Disagree</label>
                                <input type="radio" name="question<?=$i?>" value="1">
                            </span>
                            <span>
                                <label class="form-label">Disagree</label>
                                <input type="radio" name="question<?=$i?>" value="2">
                            </span>
                            <span>
                                <label class="form-label">Neutral</label>
                                <input type="radio" name="question<?=$i?>" value="3">
                            </span>
                            <span>
                                <label class="form-label">Agree</label>
                                <input type="radio" name="question<?=$i?>" value="4">
                            </span>
                            <span>
                                <label class="form-label">Strongly Agree</label>
                                <input type="radio" name="question<?=$i?>" value="5">
                            </span>
                        </div>
                    </div>
                    <?php $i = $i + 1; ?>

                <?php endforeach; ?>

                <?php
                
                if($errMsg)
                {
                    ?>
                        <div class="row mb-3">
                            <div class="offset-sm-3 col-sm-6">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                                    <?php echo $errMsg; $errMsg=""; ?>
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