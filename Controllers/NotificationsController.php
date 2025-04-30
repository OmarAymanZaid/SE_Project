<?php

require_once '../../Controllers/ConstantsController.php';

class NotificationsController
{
    protected $db;


    public function getSpecificUserNotifications($userID)
    {
        $this->db=new DBController;

        if($this->db->openConnection())
        {
            $qry="SELECT notificationText FROM notifications WHERE userId = $userID;";
            $result = $this->db->select($qry);

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo "Error in Database Connection";
            return false; 
        }
    }

    public function getCourseAnnouncements($userID)
    {
        $this->db=new DBController;

        if($this->db->openConnection())
        {
            $qry="SELECT announcementText FROM announcements JOIN student_courses ON announcements.courseID = student_courses.courseID WHERE student_courses.studentId = $userID;";
            $result = $this->db->select($qry);

            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo "Error in Database Connection";
            return false; 
        }
    }

}

?>