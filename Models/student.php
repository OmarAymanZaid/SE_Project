<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';
require_once '../../Models/notification.php';


class Student extends User
{
    protected $db;

    public function enrollInCourse($courseID, $userID)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {

            $qry = "INSERT INTO student_courses VALUES($courseID, $userID)";
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

    public function dropCourse($courseID, $studentID)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {

            $qry = "DELETE FROM student_courses WHERE courseID = $courseID AND $studentID = $studentID";
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

    public function uploadAssignment($studentID ,$courseID ,$assignmentName, $location)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {

            $qry = "INSERT INTO assignments VALUES('',$studentID ,$courseID, '$assignmentName', '$location')";
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

}

?>