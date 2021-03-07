<?php
    class db{
        // Properties
        private $dbhost = 'localhost';
        private $dbuser = 'G16';			// !! Bitte auf eigene Daten ändern !!!!
        private $dbpass = 'mu19man'; 			// !! Bitte auf eigene Daten ändern !!!!
        private $dbname = 'g16';			// !! Bitte auf eigene Daten ändern !!!!
        // Connect
        public function connect(){
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }