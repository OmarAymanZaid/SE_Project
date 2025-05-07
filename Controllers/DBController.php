<?php

    class DBController
    {
        private $dbHost = "localhost";
        private $dbUser = "root";
        private $dbPassword = "";
        private $dbName = "learning";
        private $connection;
        private static $instance;


        private function __construct()
        {
            $this->openConnection();
        }


        public static function getInstance()
        {
            if (self::$instance === null) 
            {
                self::$instance = new DBController();
            }
            return self::$instance;
        }


        public function openConnection()
        {
            $this->connection = new mysqli($this->dbHost , $this->dbUser , $this->dbPassword , $this->dbName);

            if($this->connection->connect_error)
            {
                echo "Error In Connection :" . $this->connection->connect_error;
                return false;
            }
            else
            {
                return true;
            }

        }


        public function closeConnection()
        {
            if($this->connection)
            {
                $this->connection->close();
            }
            else
            {
                echo 'connection is not opened' ;
            }
        }


        public function select($qry)
        {
            $result = $this->connection->query($qry);

            if(!$result)
            {
                echo 'Error : ' . $this->connection->error;
                return false;
            }
            else
            {
                return $result->fetch_all(MYSQLI_ASSOC);
            }

        }


        public function insert($qry)
        {
            $result = $this->connection->query($qry);

            if(!$result)
            {
                echo 'Error : ' . $this->connection->error;
                return false;
            }
            else
            {
                return $this->connection->insert_id;
            }
        }


        public function delete($qry)
        {
            $result = $this->connection->query($qry);

            if(!$result)
            {
                echo 'Error : ' . $this->connection->error;
                return false ;
            }
            else
            {
                return $result ;
            }
        }

        public function update($qry)
        {
            $result = $this->connection->query($qry);

            if(!$result)
            {
                echo 'Error : ' . $this->connection->error;
                return false ;
            }
            else
            {
                return $result ;
            }
        }

    }

?>