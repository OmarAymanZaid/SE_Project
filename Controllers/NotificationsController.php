<?php

require_once '../../Controllers/ConstantsController.php';
require_once '../../Models/user.php';
require_once '../../Models/admin.php';
require_once '../../Models/student.php';
require_once '../../Models/teacher.php';
require_once '../../Models/evaluationQuestion.php';
require_once '../../Models/notification.php';
require_once '../../Models/announcement.php';

class NotificationsController
{
    protected $db;


    public function getSpecificUserNotifications($userID)
    {
        $user = new User();
        return $user->getSpecificUserNotifications($userID);
    }

    public function getNotifications()
    {
        $admin = new Admin();
        return $admin->getNotifications();
    }

    public function addNotification($notification)
    {
        $admin = new Admin();
        return $admin->addNotification($notification);
    }

    public function getCourseAnnouncements($userID)
    {
        $student = new Student();
        return $student->getCourseAnnouncements($userID);
    }

    public function sendAnnouncement(Announcement $announcement)
    {
        $teacher = new Teacher();
        return $teacher->sendAnnouncement($announcement);
    }

}

?>