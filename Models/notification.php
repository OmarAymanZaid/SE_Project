<?php

class Notification
{
    private $ID;
    private $userID;
    private $notificationText;


    public function getID()
    {
        return $this->ID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getNotificationText()
    {
        return $this->notificationText;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function setNotificationText($notificationText)
    {
        $this->notificationText = $notificationText;
    }
}

?>