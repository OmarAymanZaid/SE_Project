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
        return $userModel->login($user);
    }

    public function register(User $user)
    {
        $userModel = new User();
        return $userModel->register($user);
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