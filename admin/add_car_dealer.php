<?php
ob_start(); 

    require_once('config.php');
    session_start();

    $stmt = $conn->prepare("Select adminid from administrator where username =?");
    $stmt->bind_param("s", $username);
    $username = stripslashes($_SESSION['adminUsername']);
    $stmt->execute(); 
    $stmt->bind_result($admin_id);
    $stmt->fetch();
    $stmt->close();

        $stmt7 = $conn->prepare("insert into cardealer (username,password,email,admin_id) values(?,?,?,?)");
        $stmt7->bind_param("sssd", $username,$password,$email,$admin_id);
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);
        $email = stripslashes($_POST['email']);
        $stmt7->execute();
        print($stmt7 -> error);
        $stmt7->close();
       header('Location: admin.php');
?>









