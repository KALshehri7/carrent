<?php
ob_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$title = "Login";
    if(isset($_SESSION['userUsername'])) {
        $title = "Logout";
    }
//<?php session_destroy();
?>
<div class="header">
    <div><img src="image/icon.png" class="car-logo" alt="Site logo"/></div>
    <div class="clear-both"></div>
    <div class="menu-header">
        <div id="menu-header-left-section">
            <!-- for development
            <span><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a></span>
             -->
             <span>
                <!-- <a href="http://autoexpress.c1.biz"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a> -->
                <a href="index.php" onclick=""><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a>

            </span>
            <span>
                <!-- <a href="http://autoexpress.c1.biz"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a> -->
                <a href="logout.php" onclick=""><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;<?php echo $title; ?></a>

            </span>


            <span>
                <!-- <a href="http://autoexpress.c1.biz"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a> -->
                <a href="admin/sign-in.php" onclick=""><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Admin Login</a>

            </span>

            <span>
                <!-- <a href="http://autoexpress.c1.biz"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Used Vehicles</a> -->
                <a href="car dealer/sign-in.php" onclick=""><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Car Dealer Login</a>

            </span>

            
        </div>
        <div class="clear-both"></div>
    </div>
</div>