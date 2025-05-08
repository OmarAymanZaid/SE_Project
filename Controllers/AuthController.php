<?php

require_once '../../Models/user.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/ConstantsController.php';
require_once '../../Controllers/SessionController.php';

if(!isSessionStarted())
{
    session_start();
}

class AuthController
{
    protected $db;


    public function login(User $user)
    {
        $userModel = new User();
        $result = $userModel->login($user);

        if($result === false)
        {
            echo 'error in query';
            return false ;
        }
        else
        {
            if(count($result) == 0)
            {
                $_SESSION['errMsg'] = 'wrong email or password';
                return false ;
            }
            else
            {
                $_SESSION['userID'] = $result[0]['ID'];
                $_SESSION['userName'] = $result[0]['name'];
                $_SESSION['userEmail'] = $result[0]['email'];
                $_SESSION['userImage'] = $result[0]['image'];
                
                if($result[0]['roleID'] == ADMIN_ROLE)
                {
                    $_SESSION['userRole'] = 'admin';
                }
                else if($result[0]['roleID'] == STUDENT_ROLE)
                {
                    $_SESSION['userRole'] = 'student';
                }
                else
                {
                    $_SESSION['userRole'] = 'teacher';
                }

                return true;
            }
        }
    }

    public function register(User $user)
    {
        $userModel = new User();
        $result    = $userModel->register($user);

        if($result != false)
        {
            $_SESSION['userID'] = $result;
            $_SESSION['userName'] = $user->name;
            $_SESSION['userImage'] = $user->image;
            if($user->roleID == ADMIN_ROLE)
                $_SESSION['userRole'] = "admin";
            elseif($user->roleID == STUDENT_ROLE)
                $_SESSION['userRole'] = "student";
            else
                $_SESSION['userRole'] = "teacher";

            return true;
        }

    }

    public function logout()
    {
        $userModel = new User();
        return $userModel->logout();
    }

    public function redirectIfUnathuorized($role)
    {
        $userModel = new User();
        return $userModel->redirectIfUnathuorized($role);
    }
}

?>