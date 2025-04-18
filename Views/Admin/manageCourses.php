<?php

require_once '../../Models/admin.php';
require_once '../../Controllers/SessionController.php';
require_once '../../Controllers/ConstantsController.php';
require_once '../../Controllers/CourseController.php';
require_once '../../Controllers/AuthController.php';


// $userRole              = "admin";
// $auth                  = new AuthController;    
// $auth->redirectIfUnathuorized($userRole);

if(!isSessionStarted())
{
    session_start();
}

$courseController = new CourseController;
$delMsg = "";

if(isset($_POST['delete']))
{
    if($courseController->deleteCourse($_POST['courseID']))
    {
        $deleteMsg = true;
    }
}

$courses = $courseController->getAllCourses();

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Admin</title>
    <?php include '../reusable/reusableHeader.php'; ?>

</head>
<body>

    <?php include 'navAdmin.php'; ?>

    
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
            
            <?php if(count($courses) == 0 ): ?>
                <h2 class="container" style="padding-top: 15px;">No Courses Available</h2>
            
            <?php else: ?>
                <h3 style="padding:10px;">Courses</h3>
                <div class="row">
                    <div class="col-md-6 col-xxl-4">
                        <?php foreach($courses as $course): ?>

                            <div class="card mb-3" style="margin:10px; padding:10px;">
                                <img class="img-fluid card-img-top" src="<?= $course['image'] ?>"
                                    alt="Card image cap" style="border: 0.8px grey solid">
                                <div class="card-body">
                                    <h5 class="card-title"> <?= $course['name'] ?> </h5>
                                    <p class="card-text"> <?= $course['description'] ?> </p>

                                    <form action="manageCourses.php" method="post">
                                            <input type="hidden" name="courseID" value="<?php echo $course["ID"] ?>">
                                            <button type="submit" class="btn btn-outline-danger" name="delete"><i class='fas fa-trash-alt' style="margin-right: 6px;"></i>Delete</button>
                                    </form>    

                                    <?php $_SESSION['courseIDForAssignCourse'] = $course["ID"]; ?>
                                    <a href="assignCourseToTeacher.php" class="btn btn-outline-primary" style="margin-top:10px" name="submit">
                                        <i class="ti ti-book" style="margin-right: 6px;"></i>Assign
                                    </a>



                                </div>
                            </div>
                            
                        <?php endforeach; ?>
                        
                    </div>
                </div>
            <?php endif;?>

        </div>

        <?php if($delMsg): ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                            <?php echo $delMsg; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div style="padding:10px;">
            <a class="btn btn-primary" href="addCourse.php" role="button">Add New Course</a>
        </div>

    </div>


    <?php include '../reusable/javascriptFiles.php'; ?>


</body>
</html>