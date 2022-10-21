<?php

    class database{
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $db_name = "php_oop";

        protected function connect(){
            $conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
            return $conn;
        }
    }


    class query extends database{
        public function getData($table_name){
            $sql = "SELECT * FROM $table_name";
            $result = $this->connect()->query($sql);
            print_r($result);
        }
    }

?>