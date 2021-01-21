<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../config/config.php');
/**
 * Database class
 */
class Database {
    
    //database variables

    public $host = HOST_NAME;
    public $user = USER_NAME;
    public $password = PASSWORD;
    public $db_name = DB_NAME;

    // connection & error variables
    public $conn;
    public $error;

    //constructor function for connecting to the database
    public function __construct(){
        $this->connectDB();
    }
    public function connectDB(){
        $this->conn = new Mysqli($this->host,$this->user,$this->password,$this->db_name);
        if(!$this->conn){
            $this->error = "connection fail ".$this->conn->connect_error;
            return false;
        }
    }
    public function selectData($query){
        $select_row = $this->conn->query($query) or die ($this->conn->error.__LINE__);
        if($select_row->num_rows > 0){
            return $select_row;
        }else{
            return false;
        }
    }
    public function insertData($query){
        $insert_row = $this->conn->query($query) or die ($this->conn->error.__LINE__);
        if($insert_row){
            return $insert_row;
        }else{
            return false;
        }
    }
    public function updateData($query){
        $update_row = $this->conn->query($query) or die ($this->conn->error.__LINE__);
        if($update_row){
            return $update_row;
        }else{
            return false;
        }
    }
    public function deleteData($query){
        $delete_row = $this->conn->query($query) or die ($this->conn->error.__LINE__);
        if($delete_row){
            return $delete_row;
        }else{
            return false;
        }
    }
}
?>