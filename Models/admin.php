<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';


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

}

?>