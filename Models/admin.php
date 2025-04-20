<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';
require_once '../../Models/notification.php';


class Admin extends User
{
    protected $db;


    public function viewAllUsers()
    {
        $this->db = new DBController;
        if($this->db->openConnection())
        {
            $qry = "select ID, name, email, roleID from users";
            $result = $this->db->select($qry);
        
            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo"Error in Connection";
        }
    }

    public function addUser(User $user)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {

            $qry = "insert into users values('' , '$user->name' , '$user->email' , '$user->password' ,'$user->roleID')";
            $result = $this->db->insert($qry);

            $this->db->closeConnection();
            return $result;

        }
        else
        {
            echo 'Failed to open the database connection : <br>';
            return false ;  
        }
    }

    public function deleteUser($userID)
    {
        $this->db = new DBController;
        if($this->db->openConnection())
        {
            $qry = "DELETE from users WHERE ID='$userID';";
            $result = $this->db->delete($qry);
        
            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo"Error in Connection";
        }
    }

    public function editUserRole($userID, $role)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry = "UPDATE users SET roleID = $role WHERE ID =$userID;";
            $result = $this->db->update($qry);
        
            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo"Error in Connection";
            return false;
        }
    }

    public function assignCourseToTeacher($teacherID, $courseID)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry = "INSERT INTO teachers_courses VALUES($teacherID, $courseID)";
            $result = $this->db->insert($qry);
        
            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo"Error in Connection";
            return false;
        }
    }

    public function addEvaluationQuestion(EvaluationQuestion $question)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry    = "INSERT INTO evaluation_questions VALUES('', '$question->questionText');";
            $result = $this->db->insert($qry); 

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo 'Error In Connection';
            return false;
        }

    }

    public function deleteQuestion($questionID)
    {
        $this->db = new DBController;
        if($this->db->openConnection())
        {
            $qry = "DELETE from evaluation_questions WHERE ID='$questionID';";
            $result = $this->db->delete($qry);
        
            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo"Error in Connection";
            return false;
        }
    }

    public function getNotifications()
    {
        $this->db=new DBController;

        if($this->db->openConnection())
        {
            $qry="SELECT notifications.ID, users.name, notificationText FROM users JOIN notifications ON users.ID = notifications.userID;";
            $result = $this->db->select($qry);

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo "Error in Database Connection";
            return false; 
        }
    }


    public function addNotification(Notification $notification)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry    = "INSERT INTO notifications VALUES('', $notification->userID,'$notification->notificationText');";
            $result = $this->db->insert($qry); 

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo 'Error In Connection';
            return false;
        }
    }
}

?>