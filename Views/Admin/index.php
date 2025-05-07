<?php

    require_once '../../Models/user.php';
    require_once '../../Models/admin.php';
    require_once '../../Models/student.php';
    require_once '../../Models/teacher.php';
    require_once '../../Models/evaluationQuestion.php';
    require_once '../../Models/notification.php';
    require_once '../../Models/announcement.php';
    require_once '../../Controllers/SessionController.php';
    require_once '../../Controllers/ConstantsController.php';
    require_once '../../Controllers/AuthController.php';
    require_once '../../Controllers/UsersController.php';


    if(!isSessionStarted())
    {
        session_start();
    }


    $userRole              = "admin";
    $auth                  = new AuthController;    
    $auth->redirectIfUnathuorized($userRole);


    $usersController = new UsersController;

    $deleteMsg = '';
    if (isset($_POST["delete"])) 
    {
        if (!empty($_POST["userID"])) 
        {
          if ($usersController->deleteUser($_POST["userID"])) 
          {
            $deleteMsg = true;
          }
        }
    }

    $editRoleMsg = '';
    if (isset($_POST["editRole"])) 
    {
        if (!empty($_POST["userID"])) 
        {

          $role;
          if($_POST["role"] == 'admin')
            $role = ADMIN_ROLE;
          elseif($_POST["role"] == 'student')
            $role = STUDENT_ROLE;
          else
            $role = TEACHER_ROLE;

          if ($usersController->editUserRole($_POST["userID"],$_POST["currentRole"] , $role))
          {
            $editRoleMsg = true;
          }

        }
    }

    if(isset($_POST['logout']))
    {
        $auth->logout();
    }

    $users = $usersController->viewAllUsers($_SESSION['userID']);

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
                <h2 class="container" style="padding-top: 15px;">No Users Available</h2>
                
                <div style="padding:10px;">
                    <a class="btn btn-primary" href="addUser.php" role="button">Add New User</a>
                </div>
            
            <?php else: ?>
                <h3 style="padding:10px;">Users</h3>

                <div style="padding:10px;">
                    <a class="btn btn-primary" href="addUser.php" role="button">Add New User</a>
                </div>
                
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
                                        <?php
                                            if($user['roleID'] == ADMIN_ROLE)
                                                echo "Admin";
                                            elseif($user['roleID'] == STUDENT_ROLE)
                                                echo "Student";
                                            else
                                                echo "Teacher";
                                        ?>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="userID" value="<?php echo $user["ID"] ?>">
                                            <button type="submit" class="btn btn-outline-danger" name="delete"><i class='fas fa-trash-alt' style="margin-right: 6px;"></i>Delete</button>
                                        </form>                   
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-outline-primary" onclick="openEditForm(<?=$user['ID'];?>)">
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
                                                <input type="hidden" value = "<?=$user['roleID'];?>" name="currentRole">
                                                <button type="submit" class="btn btn-outline-danger" name="editRole">
                                                    Edit
                                                </button>
                                            </form>                   
                                        </div>
                                    </td>
                                    <td>
                                        <a href="notify.php?userID=<?=$user['ID']?>" class="btn btn-outline-warning" name="notify">
                                            <i class="ti ti-bell" ></i>
                                            Notify
                                        </a>
                                    </td>

                                    <td>
                                        <a href="viewUserProfile.php?userProfileID=<?=$user['ID']?>" class="btn btn-outline-success">
                                            <i class="ti ti-user" ></i>
                                            Profile
                                        </a>
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

    <script>        
        function openEditForm(userID)
        {
            document.getElementById('editForm-' + userID).style.display = "flex";
        }
    </script>

    <?php include '../reusable/javascriptFiles.php'; ?>

</body>
</html>