<?php
if (!class_exists('DB')) {
    class DB {
        private $host = 'localhost';
        private $username = 'root';
        private $password = '';
        private $database = 'burger';
        private $db;
    
        public function getPDO() {
            return $this->db;
        }
    
        public function __construct($host = null, $username = null, $password = null, $database = null){
            if($host !== null){
                $this->host = $host;
                $this->username = $username;
                $this->password = $password;
                $this->database = $database;
            }
            try{
                $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND  => 'SET NAMES UTF8'));
            }
            catch (PDOException $e){
                die('Erreur : ' . $e->getMessage());
            }
        }
    
        public function query($sql, $params = array()){
            $req = $this->db->prepare($sql);
            foreach ($params as $param => $value) {
                $req->bindValue($param, $value);
            }
            $req->execute();
            return $req->fetchAll();
        }
    }}