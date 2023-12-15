<?php

if(count(get_included_files()) ==1){
    header("location:  /"); 
}
date_default_timezone_set('Asia/Riyadh');
$conn = mysqli_connect("localhost","root","");

if($conn ==  true){
    $r = mysqli_select_db($conn,"car");
    mysqli_query($conn,"SET NAMES 'utf8'");
    mysqli_query($conn,'SET CHARACTER SET utf8');
}





?>
