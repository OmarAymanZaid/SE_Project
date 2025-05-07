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

    public function getCourseMaterial($courseID)
    {
        $this->db = DBController::getInstance();
   
        $qry="SELECT * FROM material WHERE courseID = $courseID;";
        $result = $this->db->select($qry);

        return $result;
    }

    public function getCourseAnnouncements($userID)
    {
        $this->db = DBController::getInstance();
      
        $qry="SELECT announcementText FROM announcements JOIN student_courses ON announcements.courseID = student_courses.courseID WHERE student_courses.studentId = $userID;";
        $result = $this->db->select($qry);

        return $result;
    }

    public function getCoursesEnrolledByStudent($studentID)
    {
        $this->db = DBController::getInstance();


        $qry = "SELECT * from courses JOIN student_courses ON courses.ID = student_courses.courseID WHERE studentID = $studentID;";
        $result = $this->db->select($qry);
    
        return $result;
    }

    public function getNewCoursesToStudent($studentID)
    {
        $this->db = DBController::getInstance();


        $qry = "SELECT * from courses LEFT JOIN student_courses ON courses.ID = student_courses.courseID WHERE (studentID != $studentID OR studentID IS NULL) AND courses.ID NOT IN (SELECT courseID FROM student_courses WHERE studentID = $studentID);";
        $result = $this->db->select($qry);
    
        return $result;
    }

}

?>