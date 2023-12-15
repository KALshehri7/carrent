<?php
ob_start();
session_start();
require_once 'server/model/Enum.php';
require_once 'server/model/AdminLevel.php';
require_once 'server/AdminDAO.php';
require_once 'server/model/Admin.php';

if (!isset($_SESSION['adminUsername'])) {
    header('Location: sign-in.php');
} else {
    $q = new AdminDAO();
    $admin_data = $q->getAdminByUsername($_SESSION['adminUsername']);
    $adminLevel = $admin_data[0]->getAdminLevel();
    $levelArray = AdminLevel::splitAdminLevelArray(intval($adminLevel));
    $all_admin = $q->getAllAdmin();

    $canRead = $canUpdate = $canInsert = $canDelete = '';
    if (is_array($levelArray)) {
        $canRead = in_array("READ", $levelArray) == true ? 'checked' : '';
        $canUpdate = in_array("UPDATE", $levelArray) == true ? 'checked' : '';
        $canInsert = in_array("INSERT", $levelArray) == true ? 'checked' : '';
        $canDelete = in_array("DELETE", $levelArray) == true ? 'checked' : '';
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
    <link rel="stylesheet" href="css/datatables.min.css">

</head>
<body>
<div id="main-wrapper">
    <div class="template-page-wrapper">
        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php">Admin Panel</a></li>
                    <li class="active">Manage Car Dealers</li>
                </ol>
                <input type="text" class="hidden" id="admin-username" name="admin-username"
                       value="<?php echo $admin_data[0]->getUsername(); ?>">

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="vehicle-table" class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Car Dealer ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php


require_once('config.php');
    $stmt = $conn->prepare("Select cardealerid ,username,email from cardealer");
    $stmt->execute(); 
    $stmt->bind_result($cardealerid,$username,$email);
    while ($stmt->fetch()) { ?>

        <tr>
                                        <td><?php echo $cardealerid; ?></td>
                                        <td><?php echo $username;?></td>
                                        <td><?php echo $email; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-xs dropdown-toggle" type="button"
                                                        data-toggle="dropdown">Actions
                                                    <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                <li>
                                                        <a href="delete_car_dealer.php?updateId=<?php echo $cardealerid; ?>">Delete</a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
        <?php }  ?>


                                </tbody>
                            </table>
                        
                        </div>

                    </div>
                </div>


                <form action="add_car_dealer.php" method="post" name="register-form" id="register-form" class="form-horizontal templatemo-signin-form" role="form" >
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
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Add" name="register-submit" class="btn btn-default">
                    </div>
                </div>
            </div>
           
            
        </form>


                <div class="row margin-bottom-30">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/AdminPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/app.js"></script>

</body>
</html>