<?php
ob_start();
session_start();
require_once 'server/AdminDAO.php';
require_once 'server/model/Admin.php';
require_once 'server/CarDAO.php';

if (!isset($_SESSION['adminUsername'])) {
    header('Location: sign-in.php');
} else {
    $q = new AdminDAO();
    $admin_data = $q->getAdminByUsername($_SESSION['adminUsername']);
    $c = new CarDAO();
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
                <!-- <ol class="breadcrumb"><li class="active"><a href="#">Admin Panel</a></li></ol> -->
                <input type="text" class="hidden" id="admin-username" name="admin-username" value="<?php echo $admin_data[0]->getUsername(); ?>">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo count($q->getAllDealer()); ?></div>
                                        <div>Car Dealers</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="margin-bottom-30">

                </div>


            </div>
        </div>



    </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script src="js/common/CommonUtil.js"></script>
<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/AdminPageTemplate.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/app.js"></script>

</body>
</html>