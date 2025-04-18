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
            $qry    = "SELECT ID, name, email, roleID FROM users WHERE roleID = " . ADMIN_ROLE . ";";
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