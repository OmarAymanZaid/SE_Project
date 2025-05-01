<?php

require_once '../../Controllers/DBController.php';

   class QuestionsController
   {
        protected $db;

        public function getQuestions()
        {
            $this->db = DBController::getInstance();

            $qry="SELECT * from evaluation_questions";
            $result = $this->db->select($qry);

            return $result;
   
        }

        public function insertEvaluationResponse($questionID, $teacherID, $response)
        {
            $this->db = DBController::getInstance();
         
            $qry = "INSERT INTO evaluation_responses VALUES('', $questionID, $teacherID, $response);";
            $result = $this->db->insert($qry);

            return $result;

        }
   }

?>