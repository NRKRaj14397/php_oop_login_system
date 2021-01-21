<?php include_once ('inc/header.php'); ?>
    <div class="container py-5">
    <?php
        if(isset($_GET['action']) && $_GET['action'] ==='logout'){
            Session::destroy();
        }
    ?>
    <?php
        $userId = Session::get('userID');
        if($userId){
            $result = $user->getUserById($userId);
            if($result){
                $usrInfo = $result->fetch_assoc();
    ?>
        <div class="card mb-3" >
            <div class="row g-0">
                <div class="col-md-4">
                <img src="<?php echo $usrInfo['pp'];?>" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title text-white bg-success p-2 rounded-sm"><?php echo $usrInfo['quote'];?></h5><br>
                    <div class="cart-text">
                        <table class="table table-hover table-borderless">
                            <tr>
                                <td>First Name</td>
                                <td><?php echo Ucfirst($usrInfo['fname']);?></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td><?php echo Ucfirst($usrInfo['lname']);?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $usrInfo['email'];?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><?php echo $usrInfo['address'];?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-text text-right">
                        <a onclick="return confirm('Are you sure! You want to logout.')" href="?action=logout" class="btn btn-danger">Signout</a>
                    </div>
                    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                </div>
                </div>
            </div>
        </div>
    <?php
            }
        }
    ?>
       
    </div>
<?php include_once ('inc/footer.php'); ?>
    
