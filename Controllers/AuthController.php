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
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry = "select * from users where email = '$user->email' and password='$user->password'";
            $result = $this->db->select($qry);

            if($result === false)
            {
                echo 'error in query';
                
                $this->db->closeConnection();
                return false ;
            }
            else
            {
                if(count($result) == 0)
                {
                    $_SESSION['errMsg'] = 'wrong email or password';

                    $this->db->closeConnection();
                    return false ;
                }
                else
                {
                    $_SESSION['userID'] = $result[0]['ID'];
                    $_SESSION['userName'] = $result[0]['name'];
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

                    $this->db->closeConnection();
                    return true;
                }
            }
        }
        else
        {
            echo 'Failed to open the database connection : <br>';
            return false ;
        }

    }


    public function register(User $user)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $role;
            if($user->roleID == STUDENT_ROLE)
                $role = STUDENT_ROLE;
            else
                $role = TEACHER_ROLE;

            $qry = "insert into users values('' , '$user->name' , '$user->email' , '$user->password' ,'$role')";
            $result = $this->db->insert($qry);

            if($result != false)
            {
                $_SESSION['userID'] = $result;
                $_SESSION['userName'] = $user->name;
                if($user->roleID == STUDENT_ROLE)
                    $_SESSION['userRole'] = "student";
                else
                    $_SESSION['userRole'] = "teacher";


                return true;
            }
            else
            {
                $_SESSION['errMsg'] = "something went wrong .. try again";
                return false ;
            }

            $this->db->closeConnection();
        }
        else
        {
            echo 'Failed to open the database connection : <br>';
            return false ;  
        }

    }


    public function redirectIfUnathuorized($role)
    {
        if(!isset($_SESSION['userRole']))
        {
            header("location:../Auth/login.php ");
        }
        else
        {
            if($_SESSION['userRole'] != $role)
                header("location:../Auth/login.php ");
        }
    }

}

?>