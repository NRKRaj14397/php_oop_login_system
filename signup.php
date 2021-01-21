<?php
error_reporting(E_WARNING | E_PARSE);
include 'lib/Session.php';
Session::checkLogin(); 
include 'lib/Database.php';
include 'helper/Format.php';
include 'classes/User.php';
$db = new Database();
$fm = new Format();
$user = new User();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oop php - CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        ::placeholder{
            color:#ccc;
            font-size:12px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row py-4">
            <div class="col-12 col-md-8 mx-auto">
                <?php
                    if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['signupUser'])){
                        
                        $result = $user->Add_New_User($_POST,$_FILES);
                    }
                ?>
                <?php
                    if(isset($result)){
                        echo $result;
                    }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputCity">First Name</label>
                        <input type="text" class="form-control" id="inputCity" name="f_name" placeholder="Enter your first name">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputZip">Last Name</label>
                        <input type="text" class="form-control" id="inputZip" name="l_name" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="Enter Your Address" name="address">
                    </div>
                   
                    
                    <div class="form-group">
                        <label for="inputAddress2">Quote Line</label>
                        <textarea id="" rows="5" class="form-control" name="quoteLine" plcaholder="Leave your Quote here..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Profile Image</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="userImage" required="true">
                    </div>
                    <button type="submit" class="btn btn-primary" name="signupUser">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>