<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';
require_once '../../Models/notification.php';


class Admin extends User
{
    protected $db;


    public function viewAllUsers($adminID)
    {
        $this->db = DBController::getInstance();
      
        $qry = "SELECT ID, name, email, roleID FROM users WHERE ID != $adminID";
        $result = $this->db->select($qry);
    
        return $result;
      
    }

    public function addUser(User $user)
    {
        $this->db = DBController::getInstance();

        $name     = $user->getName();
        $email    = $user->getEmail();
        $password = $user->getPassword();
        $roleID   = $user->getRoleID();
        $image    = $user->getImage();

        $qry = "insert into users values('' , '$name' , '$email' , '$password' ,'$roleID', '$image')";
        $result = $this->db->insert($qry);

        return $result;

    }

    public function deleteUser($userID)
    {
        $this->db = DBController::getInstance();

        $qry = "DELETE from users WHERE ID='$userID';";
        $result = $this->db->delete($qry);
    
        return $result;
    }

    public function editUserRole($userID, $currentRole, $role)
    {
        $this->db = DBController::getInstance();

        $qry1 = "UPDATE users SET roleID = $role WHERE ID = $userID;";
        $result1 = $this->db->update($qry1);


        if($currentRole == STUDENT_ROLE)
        {
            $qry2 = "DELETE FROM student_courses WHERE studentID = $userID";
            $result2 = $this->db->update($qry2);
        }
        else if($currentRole == TEACHER_ROLE)
        {
            $qry2 = "DELETE FROM teachers_courses WHERE teacherID = $userID";
            $result2 = $this->db->update($qry2);
        }
        else
        {
            $result2 = true;
        }

        return $result1 && $result2;
    
    }

    public function assignCourseToTeacher($teacherID, $courseID)
    {
        $this->db = DBController::getInstance();

        $qry = "INSERT INTO teachers_courses VALUES($teacherID, $courseID)";
        $result = $this->db->insert($qry);
    
        return $result;

    }

    public function addEvaluationQuestion(EvaluationQuestion $question)
    {
        $this->db = DBController::getInstance();

        $questionText = $question->getQuestionText();

        $qry    = "INSERT INTO evaluation_questions VALUES('', '$questionText');";
        $result = $this->db->insert($qry); 

        return $result;

    }

    public function deleteQuestion($questionID)
    {
        $this->db = DBController::getInstance();
  
        $qry = "DELETE from evaluation_questions WHERE ID='$questionID';";
        $result = $this->db->delete($qry);
    
        return $result;
    }

    public function getNotifications()
    {
        $this->db = DBController::getInstance();

        $qry="SELECT notifications.ID, users.name, notificationText FROM users JOIN notifications ON users.ID = notifications.userID;";
        $result = $this->db->select($qry);

        return $result;
    }


    public function addNotification(Notification $notification)
    {
        $this->db = DBController::getInstance();

        $userID           = $notification->getUserID();
        $notificationText = $notification->getNotificationText();

        $qry    = "INSERT INTO notifications VALUES('', $userID,'$notificationText');";
        $result = $this->db->insert($qry); 

        return $result;
    }

    public function getCategories()
    {
        $this->db= DBController::getInstance();

        $qry="SELECT * from categories";
        $result = $this->db->select($qry);

        return $result; 
    }

    public function addCourse(Course $course)
    {
        $this->db = DBController::getInstance();

        $name        = $course->getName();
        $description = $course->getDescription();
        $image       = $course->getImage();
        $categoryID  = $course->getCategoryID();

        $qry = "INSERT INTO courses VALUES('', '$name', '$description', '$image', $categoryID);";
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