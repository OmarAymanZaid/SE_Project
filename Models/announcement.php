<?php

class Announcement
{
    private $ID;
    private $courseID;
    private $announcementText;

    // GettersAndSetters
    public function getID()
    {
        return $this->ID;
    }

    public function getCourseID()
    {
        return $this->courseID;
    }

    public function getAnnouncementText()
    {
        return $this->announcementText;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function setCourseID($courseID)
    {
        $this->courseID = $courseID;
    }

    public function setAnnouncementText($announcementText)
    {
        $this->announcementText = $announcementText;
    }
}

?>