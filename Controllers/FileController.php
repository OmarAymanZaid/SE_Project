<?php

require_once '../../Controllers/DBController.php';

class FileController
{
    protected $db;


    public function getCourseMaterial($courseID)
    {
        $this->db=new DBController;

        if($this->db->openConnection())
        {
            $qry="SELECT * FROM material WHERE courseID = $courseID;";
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


    public function getCourseAssignments($courseID)
    {
        $this->db=new DBController;

        if($this->db->openConnection())
        {
            $qry="SELECT u.name as sentBy, a.name as name, a.location FROM assignments AS a JOIN users AS u ON a.studentID = u.ID WHERE courseID = $courseID;";
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