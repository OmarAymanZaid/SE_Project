<?php

require_once '../../Controllers/ConstantsController.php';

class UsersController
{
    protected $db;

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

}

?>