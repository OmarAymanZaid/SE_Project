<?php

  require_once '../../Controllers/SessionController.php';
  require_once '../../Controllers/AuthController.php';
  require_once '../../Controllers/ConstantsController.php';
  require_once '../../Controllers/CourseController.php';
  require_once '../../Models/course.php';


  if(!isSessionStarted())
  {
      start_session();
  }


  $errMsg = '';
  $sucMsg = '';

  $userRole              = "admin";
  $auth                  = new AuthController;    
  $auth->redirectIfUnathuorized($userRole);

  $courseController = new CourseController;
  $categories= $courseController->getCategories();



  if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['category']) && isset($_FILES['image']))
  {
      if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['category']))
      {
          $course = new Course;

          $course->setName($_POST['name']);
          $course->setDescription($_POST['description']);
          $course->setCategoryID($_POST['category']);

          $location = "../images/"  . date("h-i-s") . $_FILES["image"]["name"];

          if (move_uploaded_file($_FILES["image"]["tmp_name"], $location))
          {
            $course->setImage($location);
            
            if ($courseController->addCourse($course)) 
            {
                header("location: manageCourses.php");
            } 
            else 
            {
                $errMsg = "Something went wrong... try again";
            }
          } 
          else
          {
            $errMsg = "Error in Upload";
          }

      }
      else
      {
          $errMsg = 'please fill in all fields';
          
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Admin | add course</title>
    <?php include '../reusable/reusableHeader.php'; ?>

</head>

<body>

    <?php include 'navAdmin.php'; ?>

    <?php include '../reusable/actualReusableHeader.php'; ?>

    <div class="pc-container">
        <div class="card-body" style="padding:15px">
            <form class="card-body" action="addCourse.php" method="POST" enctype="multipart/form-data">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Add Course</b></h3>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" placeholder="Description" name="description">
                    </div>

                    <div class="form-group mb-3">

                        <label class="form-label">Category</label>
                        <div class="col-lg-6 col-md-11 col-sm-12">
                            <select class="form-control" name="category" id="reset-simple">
                                <?php foreach($categories as $category):?>
                                    <option value="<?= $category['ID']?>"> <?= $category['name']?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Upload Image</h5>
                            </div>

                            <div class="card-body">
                                <div class="fallback">
                                    <input name="image" type="file" multiple>
                                </div>
                            </div>
                        </div>
                    </div>


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
                        <button type="submit" class="btn btn-primary" name="submitNewCourse"> Add </button>
                    </div>
            </form>
        </div>
    </div>

    <?php include '../reusable/javascriptFiles.php'; ?>

</body>
</html>