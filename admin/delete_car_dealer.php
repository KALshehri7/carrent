<?php
ob_start(); 

    require_once('config.php');
        $updateId= stripslashes($_GET['updateId']);
        $stmt7 = $conn->prepare("delete from cardealer where cardealerId=?");
        $stmt7->bind_param("d", $updateId);
        $stmt7->execute();
        $stmt7->close();
        header('Location: admin.php');
?>









