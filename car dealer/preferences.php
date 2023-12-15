<?php ob_start(); session_start();

require_once 'server/CarDealerDAO.php';
require_once 'server/model/Utility.php';
require_once 'server/model/CarDealer.php';

if(!isset($_SESSION['carDealerUsername'])) {
    header('Location: sign-in.php');
} else {
    $q = new CarDealerDAO();
    $carDealer_data = $q->getCarDealerByUsername($_SESSION['carDealerUsername']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_POST['password_1']) && !empty($_POST['password_2'])) {

            $q = new CarDealerDAO();
            $save = new CarDealer(
                $_POST["carDealer-id"],
                $_POST["username"],
                $_POST["password_1"],
                $_POST["email"],
                $q->getTimeStamp()
            );
            $q->update($save);
            header("Location: preferences.php?username=".$carDealer_data[0]->getUsername().'&updated=true');
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

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.min.css">

</head>
<body>
<div id="main-wrapper">

    <div class="template-page-wrapper">


        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">CarDealer Panel</a></li>
                    <li class="active">Preferences</li>
                </ol>
                <input type="text" class="hidden" id="carDealer-username" name="carDealer-username" value="<?php echo $carDealer_data[0]->getUsername(); ?>">
                <h1>Preferences</h1>
                
                <div class="row">
                    <div class="col-md-12">
                        <form action="" role="form" id="templatemo-preferences-form" onsubmit="return PasswordMatchValidate.validateForm();" method="post">
                            <div class="row">
                                <div class="form-group hidden">
                                    <input type="text" class="hidden" id="username" name="username" value="<?php echo $carDealer_data[0]->getUsername(); ?>">
                                </div>

                                <div class="form-group hidden">
                                    <input type="number" readonly id="carDealer-id" name="carDealer-id" value="<?php echo $carDealer_data[0]->getCarDealerId(); ?>">
                                </div>

                               

                                <div class="form-group hidden">
                                    <input type="text" readonly id="email" name="email" value="<?php echo $carDealer_data[0]->getEmail(); ?>">
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4>Username</h4>
                                        <p class="form-control-static"><?php echo $carDealer_data[0]->getUsername(); ?></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4>Email address</h4>
                                        <p class="form-control-static"><?php echo $carDealer_data[0]->getEmail(); ?></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4 for="currentPassword">Current Password</h4>
                                        <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                                               value="<?php echo $carDealer_data[0]->getPassword(); ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4 for="password_1">New Password</h4>
                                        <input type="password" class="form-control" id="password_1" name="password_1"
                                               placeholder="New Password" maxlength="10" minlength="5">
                                        <label class="util-msg"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 margin-bottom-15">
                                        <h4 for="password_2">Confirm New Password</h4>
                                        <input type="password" class="form-control" id="password_2" name="password_2"
                                               placeholder="Confirm New Password" maxlength="10" minlength="5">
                                        <label class="util-msg"></label>
                                    </div>
                                </div>
                            </div>



                            <div class="row templatemo-form-buttons">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/datatables.min.js"></script>

<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/CarDealerPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/validation/preference-validate.js"></script>
<script src="js/app.js"></script>

</body>
</html>