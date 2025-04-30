<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';
require_once '../../Models/announcement.php';


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

    public function uploadMaterial($courseID ,$materialName, $location)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {

            $qry = "INSERT INTO material VALUES('', $courseID, '$materialName', '$location')";
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

    public function sendAnnouncement(Announcement $announcement)
    {
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry    = "INSERT INTO announcements VALUES('', $announcement->courseID,'$announcement->announcementText');";
            $result = $this->db->insert($qry); 

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo 'Error In Connection';
            return false;
        }
    }

}

?>