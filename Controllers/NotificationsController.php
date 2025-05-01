<?php

require_once '../../Controllers/ConstantsController.php';

class NotificationsController
{
    protected $db;


    public function getSpecificUserNotifications($userID)
    {
        $this->db = DBController::getInstance();

        $qry="SELECT notificationText FROM notifications WHERE userId = $userID;";
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

}

?>