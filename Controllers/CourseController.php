<?php

require_once '../../Controllers/DBController.php';

   class CourseController
   {
        protected $db;

        public function getCategories()
        {
            $this->db=new DBController;

            if($this->db->openConnection())
            {
                $qry="SELECT * from categories";
                return $this->db->select($qry);
            }
            else
            {
                echo "Error in Database Connection";
                return false; 
            }
        }

        public function getAllCourses()
        {
            $this->db = new DBController;

            if($this->db->openConnection())
            {
                $qry = "SELECT * from courses;";
                $result = $this->db->select($qry);
            
                $this->db->closeConnection();
                return $result;
            }
            else
            {
                echo"Error in Connection";
                return false;
            }
        }

        public function getCoursesEnrolledByStudent($studentID)
        {
            $this->db = new DBController;

            if($this->db->openConnection())
            {
                $qry = "SELECT * from courses JOIN student_courses ON courses.ID = student_courses.courseID WHERE studentID = $studentID;";
                $result = $this->db->select($qry);
            
                $this->db->closeConnection();
                return $result;
            }
            else
            {
                echo"Error in Connection";
                return false;
            }
        }

        public function getNewCoursesToStudent($studentID)
        {
            $this->db = new DBController;

            if($this->db->openConnection())
            {
                $qry = "SELECT * from courses LEFT JOIN student_courses ON courses.ID = student_courses.courseID WHERE (studentID != $studentID OR studentID IS NULL) AND courses.ID NOT IN (SELECT courseID FROM student_courses WHERE studentID = $studentID);";
                $result = $this->db->select($qry);
            
                $this->db->closeConnection();
                return $result;
            }
            else
            {
                echo"Error in Connection";
                return false;
            }
        }

        public function getCoursesAssignedToTeacher($teacherID)
        {
            $this->db = new DBController;

            if($this->db->openConnection())
            {
                $qry = "SELECT * from courses JOIN teachers_courses ON courses.ID = teachers_courses.courseID WHERE teacherID = $teacherID;";
                $result = $this->db->select($qry);
            
                $this->db->closeConnection();
                return $result;
            }
            else
            {
                echo"Error in Connection";
                return false;
            }
        }


        public function getCoursesNewToTeacher($teacherID)
        {
            $this->db = new DBController;

            if($this->db->openConnection())
            {
                $qry = "SELECT * from courses LEFT JOIN teachers_courses ON courses.ID = teachers_courses.courseID WHERE (teacherID != $teacherID OR teacherID IS NULL) AND courses.ID NOT IN (SELECT courseID FROM teachers_courses WHERE teacherID = $teacherID);";
                $result = $this->db->select($qry);
            
                $this->db->closeConnection();
                return $result;
            }
            else
            {
                echo"Error in Connection";
                return false;
            }
        }


        public function addCourse($course)
        {
            $this->db = new DBController;

            if($this->db->openConnection())
            {
                $qry = "INSERT INTO courses VALUES('', '$course->name', '$course->description', '$course->image', $course->categoryID);";
                $result = $this->db->insert($qry);

                $this->db->closeConnection();
                return $result;
            }
            else
            {
                echo"Error in Connection";
                return false;
            }
        }

        public function deleteCourse($courseID)
        {
            $this->db = new DBController;

            if($this->db->openConnection())
            {
                $qry = "DELETE from courses WHERE ID='$courseID';";
                $result = $this->db->delete($qry);
            
                $this->db->closeConnection();
                return $result;
            }
            else
            {
                echo "Error in Connection";
                return false;
            }
        }
   }

?>