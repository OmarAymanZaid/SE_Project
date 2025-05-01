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

    public function sendAnnouncement(Announcement $announcement)
    {
        $this->db = DBController::getInstance();

        $qry    = "INSERT INTO announcements VALUES('', $announcement->courseID,'$announcement->announcementText');";
        $result = $this->db->insert($qry); 

        return $result;

    }

}

?>