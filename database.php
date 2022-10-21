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
        // get data from database
        public function getData($table_name){
            $sql = "SELECT * FROM $table_name";
            $result = $this->connect()->query($sql);
            if($result->num_rows > 0){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }else{
                return false;
            }
        }
    
        // Insert data into database
        public function insertData($table_name, $fields){
            $sql = "";
            $sql .= "INSERT INTO $table_name (".implode(",", array_keys($fields)).") VALUES ('".implode("','", array_values($fields))."')";
            $query = $this->connect()->query($sql);
            if($query){
                return true;
            }
        }

        // Update data into database
        public function updateData($table_name, $fields, $where){
            $sql = "";
            $condition = "";
            foreach($where as $key => $value){
                $condition .= $key . "='" . $value . "' AND ";
            }
            $condition = substr($condition, 0, -5);
            foreach($fields as $key => $value){
                $sql .= $key . "='".$value."', ";
            }
            $sql = substr($sql, 0, -2);
            $sql = "UPDATE $table_name SET $sql WHERE $condition";
            if(mysqli_query($this->connect(), $sql)){
                return true;
            }
        }

        // Delete data from database
        public function deleteData($table_name, $where){
            $sql = "";
            $condition = "";
            foreach($where as $key => $value){
                $condition .= $key . "='" . $value . "' AND ";
            }
            $condition = substr($condition, 0, -5);
            $sql = "DELETE FROM $table_name WHERE $condition";
            if(mysqli_query($this->connect(), $sql)){
                return true;
            }
        }
    }

?>