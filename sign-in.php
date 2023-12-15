<?php
ob_start();
session_start();
require_once 'UserDAO.php';
require_once 'User.php';
if (isset($_SESSION['userUsername'])) {
    header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exists = '3';
    $util = new Utility();
    $q = new UserDAO();
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
        // both username and password combination must be correct
        $results = $q->getUserByUsername($_POST['username']);
        // checks username
        if(!empty($results)) {
            if($results[0]->getPassword() == $password) {
                $exists = '1'; // all good
            } else {
                $exists = '2'; // incorrect password
            }
        }
    }

    // very important lines do not remove
    if($exists == '1') {
        $_SESSION['authenticated'] = 1;
        $_SESSION['userUsername'] = $_POST['username'];
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

    <!-- Primary Meta Tags -->
    <title>Car Shopping Project</title>
    <meta name="title" content="Car Shopping Project">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Car Shopping Project">
    <meta property="og:description" content="">
    <meta property="og:image" content="homePage.PNG"/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/css/templatemo_main.min.css">

</head>
<body>
<div id="main-wrapper">


    <div class="template-page-wrapper splash"  >
        <?php if(isset($exists) && $exists == '3') { ?>
        <div class="templatemo-signin-form">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="width: 100%;">
                    <div class="alert alert-warning text-center">
                        <?php echo 'This user does not exists.'; ?>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <?php } else if(isset($exists) && $exists == '2') { ?>
        <div class="templatemo-signin-form">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="width: 100%;">
                    <div class="alert alert-warning text-center">
                        <?php echo 'Password is not correct.'; ?>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <?php } else if(isset($exists) && $exists == '1') { ?>
        <div class="templatemo-signin-form">
            <div class="col-md-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8" style="width: 100%;">
                    <div class="alert alert-info text-center">
                        <?php echo 'Loading, please wait.';header( "refresh:1; url=index.php?username=".$_SESSION['userUsername']."" );?>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <?php } ?>

        <form action="" class="form-horizontal templatemo-signin-form" role="form" onsubmit="return LoginValidate.validateForm();" method="post">

            <div class="form-group">
                <div class="col-md-12">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Sign in" class="btn btn-default">
                    </div>
                </div>
            </div>
        
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="register.php">Register</a>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="admin/js/validation/login-validate.js"></script>

</body>
</html>