<?php

class User
{
    private $ID;
    private $name;
    private $email;
    private $password;
    private $roleID;
    private $image;


    public function login(User $user)
    {
        $this->db = DBController::getInstance();

        $email    = $user->getEmail();
        $password = $user->getPassword();

        $qry = "select * from users where email = '$email' and password='$password'";
        $result = $this->db->select($qry);

        return $result;

    }


    public function register(User $user)
    {
        $this->db = DBController::getInstance();

        $name     = $user->getName();
        $email    = $user->getEmail();
        $password = $user->getPassword();
        $image    = $user->getImage();

        $role;
        if($user->roleID == ADMIN_ROLE)
            $role = ADMIN_ROLE;
        elseif($user->roleID == STUDENT_ROLE)
            $role = STUDENT_ROLE;
        else
            $role = TEACHER_ROLE;

        $qry = "insert into users values('' , '$name' , '$email' , '$password' ,'$role','$image')";
        $result = $this->db->insert($qry);

        return $result;        
    }

    public function logout()
    {
        session_destroy();
    
        header('location: ../Auth/login.php');
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


    public function getUser($userID)
    {
        $this->db = DBController::getInstance();

        $qry = "SELECT * FROM users WHERE ID = $userID";
        $result = $this->db->select($qry);

        return $result;

    }


    public function getAllTeachers()
    {
        $this->db = DBController::getInstance();
        
        $qry    = "SELECT ID, name, email, roleID, image FROM users WHERE roleID = " . TEACHER_ROLE . ";";
        $result = $this->db->select($qry);

        return $result;
      
    }


    public function getAllTeachersExcept($userID)
    {
        $this->db = DBController::getInstance();

        $qry    = "SELECT ID, name, email, roleID, image FROM users WHERE roleID = " . TEACHER_ROLE . " and ID != $userID;";
        $result = $this->db->select($qry);

        return $result;

    }

    public function editUsername ($userID, $userName)
    {
        $this->db = DBController::getInstance();

        $qry = "UPDATE users SET name = '$userName' WHERE ID = $userID;";
        $result = $this->db->update($qry);
    
        return $result;
        
    }


    public function editProfilePicture ($userID, $location)
    {
        $this->db = DBController::getInstance();
    
        $qry = "UPDATE users SET image = '$location' WHERE ID = $userID;";
        $result = $this->db->update($qry);
    
        return $result;
    }

    public function getSpecificUserNotifications($userID)
    {
        $this->db = DBController::getInstance();

        $qry="SELECT notificationText FROM notifications WHERE userId = $userID;";
        $result = $this->db->select($qry);

        return $result;
        
    }

    public function getQuestions()
    {
        $this->db = DBController::getInstance();

        $qry="SELECT * from evaluation_questions";
        $result = $this->db->select($qry);

        return $result;

    }

    public function insertEvaluationResponse($teacherID, $response)
    {
        $this->db = DBController::getInstance();
     
        $qry = "INSERT INTO evaluation_responses VALUES('', $teacherID, $response);";
        $result = $this->db->insert($qry);

        return $result;
    }

    public function getAllCourses()
    {
        $this->db = DBController::getInstance();

        $qry = "SELECT * from courses;";
        $result = $this->db->select($qry);
    
        return $result;

    }

    
    // GettersAndSetters
    public function getID()
    {
        return $this->ID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoleID()
    {
        return $this->roleID;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRoleID($roleID)
    {
        $this->roleID = $roleID;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

}

?>
