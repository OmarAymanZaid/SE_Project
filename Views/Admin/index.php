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

          if ($admin->editUserRole($_POST["userID"], $role))
          {
            $editRoleMsg = true;
            $users = $admin->viewAllUsers();
          }

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

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

    <nav class="pc-sidebar">
        <div class="navbar-wrapper">

            <div class="m-header">
                <a href="../dashboard/index.html" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    <img src="../assets/images/edusmarto-logo.png" class="img-fluid logo-lg" alt="logo" style="margin-top:15px;">
                </a>
            </div>

            <div class="navbar-content">
                <ul class="pc-navbar">

                    <li class="pc-item"> </li>
                    <li class="pc-item pc-caption">
                        <label>Pages</label>
                        <i class="ti ti-news"></i>
                    </li>

                    <li class="pc-item">
                        <a href="index.php" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-lock"></i></span>
                            <span class="pc-mtext">Manage Users</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="manageCourses.php" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                            <span class="pc-mtext">Manage Courses</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="pc-header">
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>

                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none m-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false"
                        >
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                            <div class="form-group mb-0 d-flex align-items-center">
                                <i data-feather="search"></i>
                                <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
                            </div>
                            </form>
                        </div>
                    </li>

                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="header-search">
                            <i data-feather="search" class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here. . .">
                        </form>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false"
                        >
                            <i class="ti ti-mail"></i>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">

                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Message</h5>
                                <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-x text-danger"></i></a>
                            </div>

                            <div class="dropdown-divider"></div>

                            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                                <div class="list-group list-group-flush w-100">
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar">
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">3:00 AM</span>
                                                <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.</p>
                                                <span class="text-muted">2 min ago</span>
                                            </div>
                                        </div>
                                    </a>

                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar">
                                            </div>

                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">6:00 PM</span>
                                                <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p>
                                                <span class="text-muted">5 August</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-3.jpg" alt="user-image" class="user-avtar">
                                            </div>

                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">2:45 PM</span>
                                                <p class="text-body mb-1"><b>There was a failure to your setup.</b></p>
                                                <span class="text-muted">7 hours ago</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-4.jpg" alt="user-image" class="user-avtar">
                                            </div>

                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">9:10 PM</span>
                                                <p class="text-body mb-1"><b>Cristina Danny </b> invited to join <b> Meeting.</b></p>
                                                <span class="text-muted">Daily scrum meeting time</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <div class="text-center py-2">
                                <a href="#!" class="link-primary">View all</a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown pc-h-item header-user-profile">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            data-bs-auto-close="outside"
                            aria-expanded="false"
                        >
                            <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar">
                            <span>Stebin Ben</span>
                        </a>

                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">

                            <div class="dropdown-header">
                                <div class="d-flex mb-1">

                                    <div class="flex-shrink-0">
                                        <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar wid-35">
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Stebin Ben</h6>
                                        <span>UI/UX Designer</span>
                                    </div>

                                    <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-power text-danger"></i></a>
                                </div>
                            </div>

                            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button
                                    class="nav-link active"
                                    id="drp-t1"
                                    data-bs-toggle="tab"
                                    data-bs-target="#drp-tab-1"
                                    type="button"
                                    role="tab"
                                    aria-controls="drp-tab-1"
                                    aria-selected="true"
                                    ><i class="ti ti-user"></i> Profile</button
                                    >
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button
                                    class="nav-link"
                                    id="drp-t2"
                                    data-bs-toggle="tab"
                                    data-bs-target="#drp-tab-2"
                                    type="button"
                                    role="tab"
                                    aria-controls="drp-tab-2"
                                    aria-selected="false"
                                    ><i class="ti ti-settings"></i> Setting</button
                                    >
                                </li>
                            </ul>

                            <div class="tab-content" id="mysrpTabContent">
                                <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-edit-circle"></i>
                                        <span>Edit Profile</span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-user"></i>
                                        <span>View Profile</span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-clipboard-list"></i>
                                        <span>Social Profile</span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-wallet"></i>
                                        <span>Billing</span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-power"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>

                                <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-help"></i>
                                        <span>Support</span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-user"></i>
                                        <span>Account Settings</span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-lock"></i>
                                        <span>Privacy Center</span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-messages"></i>
                                        <span>Feedback</span>
                                    </a>

                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-list"></i>
                                        <span>History</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="pc-container">

        <div class="card-body">
            <h3 style="padding:10px;">Users</h3>
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
                                            <button type="submit" class="btn btn-outline-danger" name="editRole">
                                                Edit
                                            </button>
                                        </form>                   
                                    </div>
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

        <div style="padding:10px;">
            <a class="btn btn-primary" href="addUser.php" role="button">Add New User</a>
         </div>

    </div>

    <script>        
        function openEditForm(userID)
        {
            document.getElementById('editForm-' + userID).style.display = "flex";
        }
    </script>

    <script src="../assets/js/plugins/bootstrap.min.js"></script>

</body>
</html>