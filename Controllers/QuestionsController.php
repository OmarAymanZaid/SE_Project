<?php

require_once '../../Controllers/DBController.php';

   class QuestionsController
   {
        protected $db;

        public function getQuestions()
        {
            $this->db=new DBController;

            if($this->db->openConnection())
            {
                $qry="SELECT * from evaluation_questions";
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