<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';
require_once '../../Models/notification.php';


class Student extends User
{
    protected $db;

    public function enrollInCourse($courseID, $userID)
    {
        $this->db = DBController::getInstance();

        $qry = "INSERT INTO student_courses VALUES($courseID, $userID)";
        $result = $this->db->insert($qry);

        return $result;
        
    }

    public function dropCourse($courseID, $studentID)
    {
        $this->db = DBController::getInstance();

        $qry = "DELETE FROM student_courses WHERE courseID = $courseID AND $studentID = $studentID";
        $result = $this->db->delete($qry);

        return $result;
  
    }

    public function uploadAssignment($studentID ,$courseID ,$assignmentName, $location)
    {
        $this->db = DBController::getInstance();

        $qry = "INSERT INTO assignments VALUES('',$studentID ,$courseID, '$assignmentName', '$location')";
        $result = $this->db->insert($qry);

        return $result;
    }

}

?>