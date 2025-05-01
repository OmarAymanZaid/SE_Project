<?php

require_once '../../Controllers/DBController.php';

class FileController
{
    protected $db;


    public function getCourseMaterial($courseID)
    {
        $this->db = DBController::getInstance();
   
        $qry="SELECT * FROM material WHERE courseID = $courseID;";
        $result = $this->db->select($qry);

        return $result;

    }


    public function getCourseAssignments($courseID)
    {
        $this->db = DBController::getInstance();

     
        $qry="SELECT u.name as sentBy, a.name as name, a.location FROM assignments AS a JOIN users AS u ON a.studentID = u.ID WHERE courseID = $courseID;";
        $result = $this->db->select($qry);

        return $result;

    }

}

?>