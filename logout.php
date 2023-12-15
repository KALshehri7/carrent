<?php ob_start();
session_start(); ?>

<html lang="en">
<body>
<?php
if (isset($_SESSION['userUsername']) && $_SESSION['authenticated'] == 1) {
    echo "<p>Signing out... Please wait.</p>";
    session_destroy();
    header('refresh: 1; url=index.php');
}else{
    
    session_destroy();
    header('refresh: 1; url=index.php');
}
?>
</body>
</html>