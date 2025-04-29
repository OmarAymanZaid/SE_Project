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
        $this->db = new DBController;

        if($this->db->openConnection())
        {
            $qry = "UPDATE users SET name = '$userName' WHERE ID = $userID;";
            $result = $this->db->update($qry);
        
            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo"Error in Connection";
            return false;
        }
    }

    public function editProfilePicture ($userID, $location)
    {
        $this->db = new DBController;
    
        if($this->db->openConnection())
        {
            $qry = "UPDATE users SET image = '$location' WHERE ID = $userID;";
            $result = $this->db->update($qry);
        
            $this->db->closeConnection();
            return $result;
        }
        else
        {
            echo"Error in Connection";
            return false;
        }
    }

}


?>