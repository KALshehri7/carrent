<?php
ob_start(); 

    require_once('config.php');
        $updateId= stripslashes($_GET['updateId']);
        $stmt7 = $conn->prepare("update customerorder set status =? where customerorderId=?");
        $stmt7->bind_param("sd", $status,$updateId);
        $status = "Rejected";
        $stmt7->execute();
        $stmt7->close();
        header('Location: orders.php');
?>









