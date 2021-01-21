<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helper/Format.php');
/**
 * USER class stuff
 * 
 */
class User {
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function getUserById($id){
        $query = "SELECT * FROM `my_test` WHERE `id`='$id'";
        $result = $this->db->selectData($query);
        return $result;
    }
    public function Check_Valid_User($data){
        $email = mysqli_real_escape_string($this->db->conn,$this->fm->validation($data['email']));
        $password = mysqli_real_escape_string($this->db->conn,$this->fm->validation($data['password']));
        $acPassword = md5($password);
        $query = "SELECT * FROM `my_test` WHERE `email`='$email' AND `password`='$acPassword'";
        $result = $this->db->selectData($query);
        if(!$result->num_rows){
            echo '<span style="text-align:center;color:tomato;font-size:15px;">Invalid Email or Password!</span>';
        }else{
            $usr = $result->fetch_assoc();

            Session::set('loggedin',true);
            Session::set('userID',$usr['id']);
            Session::set('Avatar',$usr['pp']);
            echo '<script>location.href = "index.php"</script>';
        }
    }
    public function Add_New_User($data,$files){
        $fname = mysqli_real_escape_string($this->db->conn,$this->fm->validation($data['f_name']));
        $lname = mysqli_real_escape_string($this->db->conn,$this->fm->validation($data['l_name']));
        $email = mysqli_real_escape_string($this->db->conn,$this->fm->validation($data['email']));
        $password = mysqli_real_escape_string($this->db->conn,$this->fm->validation($data['password']));
        $address = mysqli_real_escape_string($this->db->conn,$this->fm->validation($data['address']));
        $md5pass = md5($password);
        $quoteLine = mysqli_real_escape_string($this->db->conn,$this->fm->validation($data['quoteLine']));

        $permitted = ['jpg','png','jpeg','gif'];
        $file_name = $files['userImage']['name'];
        $file_size = $files['userImage']['size'];
        $file_tmp_name = $files['userImage']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $uniq_name = substr(md5(time()),0,10).'.'.$file_ext;
        $upload_image = 'upload/'.$uniq_name;
        if(!in_array($file_ext,$permitted)){
            return '<span class="text-danger">File extension not allowed!</span>';
        }

        if(empty($fname) || empty($lname) || empty($email)|| empty($password) || empty($address) || empty($quoteLine)){
            $msg ='<span class="text-danger">All fields are required!</span>';
            return $msg;
        }else{
           $querySel = "SELECT * FROM `my_test` WHERE `email`='$email'";
           $resSel = $this->db->selectData($querySel);
           if($resSel){
               $msg = '<span class="text-warning">Email Already Exists!</span>';
               return $msg;
           }else{
                move_uploaded_file($file_tmp_name , $upload_image);
                $query = "INSERT INTO `my_test`(`fname`,`lname`,`email`,`password`,`address`,`quote`,`pp`) VALUES('$fname','$lname','$email','$md5pass','$address','$quoteLine','$upload_image')";
                $result = $this->db->insertData($query);
                if($result){
                    $msg = '<span class="text-success">User Added Successfully!</span>';
                    return $msg;
                }else{
                    $msg = '<span class="text-danger">User Addition failed!</span>';
                    return $msg;
                }
           }

        }

    }
}
?>