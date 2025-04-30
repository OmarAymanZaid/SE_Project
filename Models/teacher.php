<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';
require_once '../../Models/notification.php';


class Teacher extends User
{
    protected $db;

    public function assignForCourse($courseID, $userID)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {

            $qry = "INSERT INTO teachers_courses VALUES($userID, $courseID)";
            $result = $this->db->insert($qry);

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo "Error In Database Connection";
            return false;
        }
    }

    public function cancelCourse($courseID, $teacherID)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {

            $qry = "DELETE FROM teachers_courses WHERE courseID = $courseID AND $teacherID = $teacherID";
            $result = $this->db->delete($qry);

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo "Error In Database Connection";
            return false;
        }
    }

}

?>