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

}

?>