<?php

class User
{
    public $ID;
    public $name;
    public $email;
    public $password;
    public $roleID;
    public $image;

    
    public function editUsername ($userID, $userName)
    {
        $this->db = DBController::getInstance();

        $qry = "UPDATE users SET name = '$userName' WHERE ID = $userID;";
        $result = $this->db->update($qry);
    
        return $result;
        
    }


    public function editProfilePicture ($userID, $location)
    {
        $this->db = DBController::getInstance();
    
        $qry = "UPDATE users SET image = '$location' WHERE ID = $userID;";
        $result = $this->db->update($qry);
    
        return $result;
    }

}


?>