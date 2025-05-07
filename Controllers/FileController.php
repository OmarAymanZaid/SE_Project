<?php

require_once '../../Controllers/ConstantsController.php';
require_once '../../Models/user.php';
require_once '../../Models/admin.php';
require_once '../../Models/student.php';
require_once '../../Models/teacher.php';
require_once '../../Models/evaluationQuestion.php';
require_once '../../Models/notification.php';
require_once '../../Models/announcement.php';

class FileController
{
    protected $db;


    public function uploadAssignment($studentID, $courseID, $assignmentName, $location)
    {
        $student = new Student();
        return $student->uploadAssignment($studentID, $courseID, $assignmentName, $location);
    }

    
    public function uploadMaterial($courseID, $materialName, $location)
    {
        $teacher = new Teacher();
        return $teacher->uploadMaterial($courseID, $materialName, $location);
    }

}

?>