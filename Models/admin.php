<?php

require_once '../../Controllers/DBController.php';
require_once '../../Models/user.php';
require_once '../../Models/notification.php';


class Admin extends User
{
    protected $db;

    public function viewAllUsers()
    {
        $this->db = DBController::getInstance();
      
        $qry = "select ID, name, email, roleID from users";
        $result = $this->db->select($qry);
    
        return $result;
      
    }


    public function addUser(User $user)
    {
        $this->db = DBController::getInstance();

        $qry = "insert into users values('' , '$user->name' , '$user->email' , '$user->password' ,'$user->roleID', '$user->image')";
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


    public function editUserRole($userID, $role)
    {
        $this->db = DBController::getInstance();

        $qry = "UPDATE users SET roleID = $role WHERE ID =$userID;";
        $result = $this->db->update($qry);
    
        return $result;
    
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

        $qry    = "INSERT INTO evaluation_questions VALUES('', '$question->questionText');";
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

        $qry    = "INSERT INTO notifications VALUES('', $notification->userID,'$notification->notificationText');";
        $result = $this->db->insert($qry); 

        return $result;

    }
}

?>