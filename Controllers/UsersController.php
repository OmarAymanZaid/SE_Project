<?php

require_once '../../Controllers/ConstantsController.php';
require_once '../../Models/user.php';
require_once '../../Models/admin.php';
require_once '../../Models/student.php';
require_once '../../Models/teacher.php';
require_once '../../Models/evaluationQuestion.php';
require_once '../../Models/notification.php';
require_once '../../Models/announcement.php';

class UsersController
{
    protected $db;

    // User
    public function getUser($userID)
    {
        $user = new User();
        return $user->getUser($userID);
    }

    public function getAllTeachers()
    {
        $user = new User();
        return $user->getAllTeachers();
    }

    public function getAllTeachersExcept($userID)
    {
        $user = new User();
        return $user->getAllTeachersExcept($userID);
    }

    public function editUsername($userID, $userName)
    {
        $user = new User();
        return $user->editUsername($userID, $userName);
    }

    public function editProfilePicture($userID, $location)
    {
        $user = new User();
        return $user->editProfilePicture($userID, $location);
    }


    // Admin
    public function viewAllUsers($adminID)
    {
        $admin = new Admin();
        return $admin->viewAllUsers($adminID);
    }

    public function addUser(User $user)
    {
        $admin = new Admin();
        return $admin->addUser($user);
    }

    public function deleteUser($userID)
    {
        $admin = new Admin();
        return $admin->deleteUser($userID);
    }

    public function editUserRole($userID, $currentRole, $newRole)
    {
        $admin = new Admin();
        return $admin->editUserRole($userID, $currentRole, $newRole);
    }

}

?>
