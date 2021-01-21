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
// var_dump(Session::get('loggedin'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oop php - CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sign_in'])){
                    $result = $user->Check_Valid_User($_POST);
                }
            ?>
            <?php
                if(isset($result)){
                    echo $result;
                }
            ?>
                <form action="" method="post">
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
                    <button type="submit" class="btn btn-primary" name="sign_in">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>