<?php

    require_once '../../Models/admin.php';
    require_once '../../Controllers/SessionController.php';
    require_once '../../Controllers/ConstantsController.php';

    if(!isSessionStarted())
    {
        session_start();
    }


    $admin = new Admin;
    $users = $admin->viewAllUsers();

    $deleteMsg = '';
    if (isset($_POST["delete"])) 
    {
        if (!empty($_POST["userID"])) 
        {
          if ($admin->deleteUser($_POST["userID"])) 
          {
            $deleteMsg = true;
            $users = $admin->viewAllUsers();
          }
        }
    }

    $editUserRoleArr = array("userID" =>'', "roleID" => '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Users</title>

    <!-- [Favicon] icon -->
        <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="../assets/fonts/feather.css" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/material.css" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" >
    <link rel="stylesheet" href="../assets/css/style-preset.css" >
    <link rel="stylesheet" href="../assets/css/ourStyle.css" >

</head>
<body>  

    <div class="container">
        <div class="card-body">
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
                                    <form action="viewAllUsers.php" method="post">
                                        <input type="hidden" name="userID" value="<?php echo $user["ID"] ?>">
                                        <button type="submit" class="btn btn-outline-danger" name="delete"><i class='fas fa-trash-alt' style="margin-right: 6px;"></i>Delete</button>
                                    </form>                   
                                </td>
                                <td>
                                    <form action="viewAllUsers.php" method="post">
                                        <input type="hidden" name="userID" value="<?php echo $user["ID"] ?>">
                                        <button type="submit" class="btn btn-outline-primary" onclick="openEditForm()" name="editRole">
                                           <i class="fas fa-edit"></i>Edit
                                         </button>
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
                        <div class="alert alert-success" role="alert"> 
                            <?php echo 'User deleted successfully' ; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                ?>

            </div>
        </div>
    </div>

    <div class="justify-content-center container" style="border: 1px gray solid; padding: 15px; display:none;" id="editRoleDiv">
        <form action="viewAllUsers.php" method="post">
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
            <button type="submit" class="btn btn-outline-danger" name="editRole">
                     Edit
            </button>
        </form>                   
    </div>

    <script>
        const editRoleDiv = document.querySelector("#editRoleDiv");
        
        function openEditForm()
        {
            editRoleDiv.style.display = "flex";
        }

        // function closeEditForm()
        // {
        //     editRoleDiv.style.display = "none";
        // }

    </script>
</body>
</html>