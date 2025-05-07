<?php

require_once '../../Controllers/ConstantsController.php';
require_once '../../Models/user.php';
require_once '../../Models/admin.php';
require_once '../../Models/student.php';
require_once '../../Models/teacher.php';
require_once '../../Models/evaluationQuestion.php';
require_once '../../Models/notification.php';
require_once '../../Models/announcement.php';

   class CourseController
   {
        protected $db;

        // User
        public function getAllCourses()
        {
            $user = new User();
            return $user->getAllCourses();
        }

        // Admin
        public function assignCourseToTeacher($teacherID, $courseID)
        {
            $admin = new Admin();
            return $admin->assignCourseToTeacher($teacherID, $courseID);
        }

        public function getCategories()
        {
            $admin = new Admin();
            return $admin->getCategories();
        }
    
        public function addCourse(Course $course)
        {
            $admin = new Admin();
            return $admin->addCourse($course);
        }
    
        public function deleteCourse($courseID)
        {
            $admin = new Admin();
            return $admin->deleteCourse($courseID);
        }

        // Student
        public function enrollInCourse($courseID, $userID)
        {
            $student = new Student();
            return $student->enrollInCourse($courseID, $userID);
        }
    
        public function dropCourse($courseID, $studentID)
        {
            $student = new Student();
            return $student->dropCourse($courseID, $studentID);
        }
        public function getCourseMaterial($courseID)
        {
            $student = new Student();
            return $student->getCourseMaterial($courseID);
        }
    
        public function getCoursesEnrolledByStudent($studentID)
        {
            $student = new Student();
            return $student->getCoursesEnrolledByStudent($studentID);
        }
    
        public function getNewCoursesToStudent($studentID)
        {
            $student = new Student();
            return $student->getNewCoursesToStudent($studentID);
        }

        
        // Teacher
        public function assignForCourse($courseID, $userID)
        {
            $teacher = new Teacher();
            return $teacher->assignForCourse($courseID, $userID);
        }
    
        public function cancelCourse($courseID, $teacherID)
        {
            $teacher = new Teacher();
            return $teacher->cancelCourse($courseID, $teacherID);
        }
    
        public function getCourseAssignments($courseID)
        {
            $teacher = new Teacher();
            return $teacher->getCourseAssignments($courseID);
        }
    
        public function getCoursesAssignedToTeacher($teacherID)
        {
            $teacher = new Teacher();
            return $teacher->getCoursesAssignedToTeacher($teacherID);
        }
    
        public function getCoursesNewToTeacher($teacherID)
        {
            $teacher = new Teacher();
            return $teacher->getCoursesNewToTeacher($teacherID);
        }
   }

?>