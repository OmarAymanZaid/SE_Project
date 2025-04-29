<?php

require_once '../../Controllers/ConstantsController.php';

class UsersController
{
    protected $db;

    public function getAllTeachers()
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry    = "SELECT ID, name, email, roleID, image FROM users WHERE roleID = " . TEACHER_ROLE . ";";
            $result = $this->db->select($qry);

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo "Error in database connection";
            return false;
        }
    }

    public function getAllTeachersExcept($userID)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry    = "SELECT ID, name, email, roleID, image FROM users WHERE roleID = " . TEACHER_ROLE . " and ID != $userID;";
            $result = $this->db->select($qry);

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo "Error in database connection";
            return false;
        }
    }

}

?>