<?php

require_once '../../Controllers/DBController.php';

   class CourseController
   {
        protected $db;

        public function getCategories()
        {
            $this->db= DBController::getInstance();

            $qry="SELECT * from categories";
            $result = $this->db->select($qry);
    
            return $result; 

        }

        public function getAllCourses()
        {
            $this->db = DBController::getInstance();

            $qry = "SELECT * from courses;";
            $result = $this->db->select($qry);
        
            return $result;

        }

        public function getCoursesEnrolledByStudent($studentID)
        {
            $this->db = DBController::getInstance();


            $qry = "SELECT * from courses JOIN student_courses ON courses.ID = student_courses.courseID WHERE studentID = $studentID;";
            $result = $this->db->select($qry);
        
            return $result;

        }

        public function getNewCoursesToStudent($studentID)
        {
            $this->db = DBController::getInstance();


            $qry = "SELECT * from courses LEFT JOIN student_courses ON courses.ID = student_courses.courseID WHERE (studentID != $studentID OR studentID IS NULL) AND courses.ID NOT IN (SELECT courseID FROM student_courses WHERE studentID = $studentID);";
            $result = $this->db->select($qry);
        
            return $result;

        }

        public function getCoursesAssignedToTeacher($teacherID)
        {
            $this->db = DBController::getInstance();


            $qry = "SELECT * from courses JOIN teachers_courses ON courses.ID = teachers_courses.courseID WHERE teacherID = $teacherID;";
            $result = $this->db->select($qry);
        
            return $result;

        }


        public function getCoursesNewToTeacher($teacherID)
        {
            $this->db = DBController::getInstance();

            $qry = "SELECT * from courses LEFT JOIN teachers_courses ON courses.ID = teachers_courses.courseID WHERE (teacherID != $teacherID OR teacherID IS NULL) AND courses.ID NOT IN (SELECT courseID FROM teachers_courses WHERE teacherID = $teacherID);";
            $result = $this->db->select($qry);
        
            return $result;

        }


        public function addCourse($course)
        {
            $this->db = DBController::getInstance();

            $qry = "INSERT INTO courses VALUES('', '$course->name', '$course->description', '$course->image', $course->categoryID);";
            $result = $this->db->insert($qry);

            return $result;

        }

        public function deleteCourse($courseID)
        {
            $this->db = DBController::getInstance();

            $qry = "DELETE from courses WHERE ID='$courseID';";
            $result = $this->db->delete($qry);
        
            return $result;

        }
   }

?>