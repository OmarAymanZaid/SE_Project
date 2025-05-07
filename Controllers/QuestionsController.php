<?php

require_once '../../Controllers/ConstantsController.php';
require_once '../../Models/user.php';
require_once '../../Models/admin.php';
require_once '../../Models/student.php';
require_once '../../Models/teacher.php';
require_once '../../Models/evaluationQuestion.php';
require_once '../../Models/notification.php';
require_once '../../Models/announcement.php';

   class QuestionsController
   {
        protected $db;

        public function getQuestions()
        {
            $user = new User();
            return $user->getQuestions();
        }
    
        public function insertEvaluationResponse($teacherID, $response)
        {
            $user = new User();
            return $user->insertEvaluationResponse($teacherID, $response);
        }

        public function addEvaluationQuestion(EvaluationQuestion $question)
        {
            $admin = new Admin();
            return $admin->addEvaluationQuestion($question);
        }

        public function deleteQuestion($questionID)
        {
            $admin = new Admin();
            return $admin->deleteQuestion($questionID);
        }

   }

?>