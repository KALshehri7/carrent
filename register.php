<?php
ob_start();
session_start();
require_once 'admin/server/model/Dbh.php';
require_once 'UserDAO.php';




if (isset($_SESSION['userUsername'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = null;
    $condition = 0;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $q = new UserDAO();

    $msgTaken = null;
    if (count($q->getUserByUsername($username)) > 0) {
        $msgTaken = 'This username is already taken.';
    } else {
        if (!empty($username) && !empty($email) && !empty($password)) {
            if ($q->create($username, $email, $password)) {
                $cond = 1;
            }
        }
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

    <div class="template-page-wrapper splash2">


        <?php if (isset($cond) && $cond === 1) { ?>
		<div class="templatemo-signin-form">
			<div class="col-md-12">
				<div class="col-sm-2"></div>
				<div class="col-sm-8" style="width: 100%;">
					<div class="alert alert-success text-center">Success! <?php echo 'Redirecting to login page, please wait.';?></div>
                    <?php header( "refresh:4; url=sign-in.php"); ?>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
		<?php } ?>

        <?php if (!empty($msgTaken)) { ?>
            <div class="templatemo-signin-form">
                <div class="col-md-12">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8" style="width: 100%;">
                        <div class="alert alert-warning text-center"><?php echo $msgTaken; ?></div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        <?php } ?>
		
        <form action="" method="post" onsubmit="return RegisterValidate.validateForm();" name="register-form" id="register-form" class="form-horizontal templatemo-signin-form" role="form" >
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
                    <label for="password" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@domain.com">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" minlength="5" maxlength="10" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label for="password" class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" minlength="5" maxlength="10" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Register" name="register-submit" class="btn btn-default">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="sign-in.php">Login</a>
                    </div>
                </div>
            </div>
            
        </form>

       
    </div>
</div>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jquery.min.js"></script>

<script src="admin/js/validation/register-validate.js"></script>

</body>
</html>