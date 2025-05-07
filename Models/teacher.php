<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';
require_once '../../Models/announcement.php';


class Teacher extends User
{
    protected $db;

    
    public function assignForCourse($courseID, $userID)
    {
        $this->db = DBController::getInstance();

        $qry = "INSERT INTO teachers_courses VALUES($userID, $courseID)";
        $result = $this->db->insert($qry);

        return $result;
    
    }

    public function cancelCourse($courseID, $teacherID)
    {
        $this->db = DBController::getInstance();

        $qry = "DELETE FROM teachers_courses WHERE courseID = $courseID AND $teacherID = $teacherID";
        $result = $this->db->delete($qry);

        return $result;
  
    }

    public function uploadMaterial($courseID ,$materialName, $location)
    {
        $this->db = DBController::getInstance();

        $qry = "INSERT INTO material VALUES('', $courseID, '$materialName', '$location')";
        $result = $this->db->insert($qry);

        return $result;
     
    }

    public function getCourseAssignments($courseID)
    {
        $this->db = DBController::getInstance();

     
        $qry="SELECT u.name as sentBy, a.name as name, a.location FROM assignments AS a JOIN users AS u ON a.studentID = u.ID WHERE courseID = $courseID;";
        $result = $this->db->select($qry);

        return $result;

    }

    public function sendAnnouncement(Announcement $announcement)
    {
        $this->db = DBController::getInstance();

        $courseID         = $announcement->getCourseID();
        $announcementText = $announcement->getAnnouncementText();

        $qry    = "INSERT INTO announcements VALUES('', $courseID,'$announcementText');";
        $result = $this->db->insert($qry); 

        return $result;
    }

    
    public function getCoursesAssignedToTeacher($teacherID)
    {
        $this->db = DBController::getInstance();


        $qry = "SELECT * from courses JOIN teachers_courses ON courses.ID = teachers_courses.courseID WHERE teacherID = $teacherID;";
        $result = $this->db->select($qry);
    
        return $result;
    }

    public function getCoursesNewToTeacher($teacherID)
    {
        $this->db = DBController::getInstance();

        $qry = "SELECT * from courses LEFT JOIN teachers_courses ON courses.ID = teachers_courses.courseID WHERE (teacherID != $teacherID OR teacherID IS NULL) AND courses.ID NOT IN (SELECT courseID FROM teachers_courses WHERE teacherID = $teacherID);";
        $result = $this->db->select($qry);
    
        return $result;

    }

}

?>